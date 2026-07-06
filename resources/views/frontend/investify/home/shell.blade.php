@extends('frontend::layouts.app')
@section('title')
    {{ __('Home') }}
@endsection
@section('content')
    <div id="home-content">
        <section class="banner light-blue-bg">
            <div class="container py-5 text-center">
                <div class="spinner-border text-primary" role="status" aria-hidden="true"></div>
            </div>
        </section>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('home-content');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            fetch(@json(route('home.content')), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                    'X-CSRF-TOKEN': csrfToken ?? ''
                },
                credentials: 'same-origin'
            })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Failed to load home content');
                    }

                    return response.text();
                })
                .then(function (html) {
                    container.innerHTML = html;

                    if (typeof AOS !== 'undefined') {
                        AOS.init();
                    }

                    if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
                        lucide.createIcons();
                    }
                })
                .catch(function () {
                    container.innerHTML = '<section class="banner light-blue-bg"><div class="container py-5 text-center"><p>{{ __('Unable to load page content. Please refresh and try again.') }}</p></div></section>';
                });
        });
    </script>
@endpush

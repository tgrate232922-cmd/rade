{{-- resources/views/backend/investment/include/__action.blade.php --}}
<div class="btn-group" role="group" aria-label="Actions">
    {{-- Delete --}}
    <form action="{{ route('admin.investments.destroy', $id) }}"
          method="POST"
          onsubmit="return confirm('Delete this investment? This cannot be undone.');"
          style="display:inline-block;margin:0;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            {{ __('Delete') }}
        </button>
    </form>
</div>

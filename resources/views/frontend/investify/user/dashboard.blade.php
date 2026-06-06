@extends('frontend::layouts.user')
@section('title')
{{ __('Dashboard') }}
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('global/css/modern-dashboard.css') }}?v={{ time() }}">
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Remove ALL spacing and backgrounds */
    * {
        box-sizing: border-box !important;
    }
    
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        min-height: 100vh !important;
        background: linear-gradient(135deg, #0a1f1c 0%, #081317 50%, #025443 100%) !important;
        background-attachment: fixed !important;
        overflow-x: hidden !important;
    }
    
    /* Force remove background images on main containers */
    body,
    .main-wrapper,
    .user-panel,
    .dashboard-wrapper,
    .site-wrapper,
    .page-wrapper,
    .content-wrapper,
    main {
        background: linear-gradient(135deg, #0a1f1c 0%, #081317 50%, #025443 100%) !important;
        background-attachment: fixed !important;
        background-image: none !important;
    }
    
    /* Remove container spacing but keep header spacing */
    .container-fluid.default-page {
        padding: 0 !important;
        margin: 0 !important;
        background: transparent !important;
    }
    
    /* Dashboard wrapper full height */
    .modern-dashboard-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        min-height: calc(100vh - 80px) !important;
        background: linear-gradient(135deg, #0a1f1c 0%, #081317 50%, #025443 100%) !important;
    }
    
    .dashboard-main-content {
        padding: 24px !important;
        max-width: 1400px !important;
        margin: 0 auto !important;
    }
    
    /* Keep header/nav spacing intact */
    .site-header,
    .navbar,
    .user-panel-header,
    .top-nav,
    .main-header {
        margin: revert !important;
        padding: revert !important;
    }
    
    .site-header *,
    .navbar *,
    .user-panel-header *,
    .top-nav *,
    .main-header * {
        margin: revert !important;
        padding: revert !important;
    }
    
  /* ==========================================
   Blue Glass Dashboard Notification Popup
========================================== */

#userPopupNotification .modal-dialog{
    max-width: 560px;
}

#userPopupNotification .modal-content{
    max-height: 86vh;
    background:
        radial-gradient(circle at top right, rgba(59,130,246,0.18), transparent 32%),
        radial-gradient(circle at bottom left, rgba(34,211,238,0.10), transparent 36%),
        linear-gradient(135deg, #07111f 0%, #0b1728 48%, #111827 100%);
    border: 1px solid rgba(148,163,184,0.18);
    border-radius: 22px;
    box-shadow: 0 22px 55px rgba(0,0,0,0.42);
    overflow: hidden;
    position: relative;
}

#userPopupNotification .modal-content::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        linear-gradient(to right, rgba(255,255,255,.045) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,.045) 1px, transparent 1px);
    background-size: 38px 38px;
    opacity:.14;
    pointer-events:none;
}

#userPopupNotification .popup-body{
    padding: 24px;
    color:#fff;
    position:relative;
    z-index:2;
    display:flex;
    flex-direction:column;
    max-height:86vh;
    overflow:hidden;
}

#userPopupNotification .popup-body-text{
    overflow-y:auto;
    padding-right:8px;
    flex:1;
    max-height:68vh;
}

#userPopupNotification .title{
    font-size:20px;
    font-weight:800;
    line-height:1.25;
    color:#60a5fa;
    margin:0 0 12px;
}

#userPopupNotification .popup-body-text p{
    font-size:13px;
    line-height:1.65;
    color:rgba(226,232,240,0.78);
    margin-bottom:16px;
}

#userPopupNotification .site-btn-sm.primary-btn{
    position:sticky;
    bottom:0;
    margin-top:14px;
    background:linear-gradient(135deg,#2563eb 0%,#38bdf8 100%);
    color:#ffffff !important;
    border:none;
    border-radius:12px;
    padding:11px 20px;
    font-size:13px;
    font-weight:800;
    box-shadow:0 12px 26px rgba(37,99,235,.22);
    display:inline-block;
}

#userPopupNotification .btn-close{
    position:absolute;
    top:16px;
    right:16px;
    filter:invert(1);
    opacity:.65;
    z-index:5;
}

#userPopupNotification .btn-close:hover{
    opacity:1;
    transform:rotate(90deg);
}

#userPopupNotification .popup-body-text::-webkit-scrollbar{
    width:6px;
}

#userPopupNotification .popup-body-text::-webkit-scrollbar-track{
    background:rgba(255,255,255,0.05);
    border-radius:20px;
}

#userPopupNotification .popup-body-text::-webkit-scrollbar-thumb{
    background:linear-gradient(180deg,#2563eb,#38bdf8);
    border-radius:20px;
}

.modal-backdrop.show{
    opacity:.78;
    backdrop-filter:blur(4px);
}

@media(max-width:768px){
    #userPopupNotification .modal-dialog{
        margin:14px;
    }

    #userPopupNotification .popup-body{
        padding:20px 16px;
    }

    #userPopupNotification .title{
        font-size:17px;
        padding-right:28px;
    }

    #userPopupNotification .popup-body-text p{
        font-size:12px;
    }

    #userPopupNotification .site-btn-sm.primary-btn{
        width:100%;
        text-align:center;
    }
}
/* =========================================================
   FIXED BLUE GLASS DASHBOARD THEME
   Paste at bottom of modern-dashboard.css
========================================================= */

html,
body{
    background:
        radial-gradient(circle at 20% 8%, rgba(56,189,248,.16), transparent 24%),
        radial-gradient(circle at 85% 28%, rgba(37,99,235,.14), transparent 30%),
        linear-gradient(135deg,#06111f 0%,#0a2030 50%,#06121f 100%) !important;
    background-attachment: fixed !important;
}

.modern-dashboard-wrapper{
    min-height:100vh !important;
    background:transparent !important;
    position:relative !important;
    overflow:hidden !important;
}

.modern-dashboard-wrapper::before{
    content:"" !important;
    position:absolute !important;
    inset:0 !important;
    background-image:radial-gradient(rgba(125,211,252,.13) 1px, transparent 1px) !important;
    background-size:18px 18px !important;
    opacity:.25 !important;
    pointer-events:none !important;
    z-index:0 !important;
}

.dashboard-main-content{
    position:relative !important;
    z-index:2 !important;
    max-width:1320px !important;
    padding:24px !important;
    margin:0 auto !important;
}

/* glass cards */
.dashboard-info-bar,
.stat-card,
.balance-card,
.quick-actions-card,
.mobile-quick-action-tile,
.profile-box,
.locked-period-box,
.top-pools-card,
.pool-trend-card,
.staking-plan-card,
.transactions-card{
    background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62)) !important;
    border:1px solid rgba(125,211,252,.20) !important;
    box-shadow:
        0 28px 70px rgba(0,0,0,.34),
        inset 0 1px 0 rgba(255,255,255,.10) !important;
    backdrop-filter:blur(24px) saturate(145%) !important;
    -webkit-backdrop-filter:blur(24px) saturate(145%) !important;
    border-radius:24px !important;
}

/* remove old green overlays */
.stat-card::before,
.balance-card::before,
.profile-box::before,
.locked-period-box::before,
.staking-plan-card::before{
    background:radial-gradient(circle at 75% 0%, rgba(125,211,252,.18), transparent 24%) !important;
    opacity:.75 !important;
}

/* blue accents */
.info-item-icon,
.stat-icon,
.stat-trend,
.stat-trend svg,
.profile-header svg,
.plan-detail-label svg,
.view-all-link,
.plan-roi-value,
.plan-detail-value.highlight,
.profile-achievements-value{
    color:#67e8f9 !important;
}

.stat-icon-wrapper,
.plan-icon-wrapper,
.profile-edit-btn,
.quick-action-icon,
.mobile-action-icon-wrapper{
    background:linear-gradient(135deg,#67e8f9,#2563eb) !important;
    border:1px solid rgba(125,211,252,.35) !important;
    box-shadow:0 0 26px rgba(56,189,248,.22) !important;
}

.stat-icon-wrapper svg,
.plan-icon-wrapper svg,
.quick-action-icon svg,
.mobile-action-icon-wrapper svg{
    color:#ffffff !important;
}

/* buttons */
.plan-action-btn,
.view-all-btn,
.top-pools-refresh-btn{
    background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%) !important;
    color:#ffffff !important;
    border:none !important;
    box-shadow:0 16px 36px rgba(37,99,235,.30) !important;
}

.plan-action-btn:hover,
.view-all-btn:hover{
    box-shadow:0 20px 46px rgba(37,99,235,.42) !important;
}

/* quick actions */
.quick-action-btn{
    background:rgba(25,43,73,.56) !important;
    border:1px solid rgba(125,211,252,.14) !important;
    border-radius:18px !important;
}

.quick-action-btn:hover{
    background:rgba(56,189,248,.12) !important;
    border-color:rgba(56,189,248,.35) !important;
}

/* balance chart */
#balanceChartPath{
    stroke:rgba(103,232,249,.55) !important;
}

#balanceChartArea{
    fill:rgba(103,232,249,.08) !important;
}

.balance-apy-badge{
    background:rgba(56,189,248,.10) !important;
    border-color:rgba(125,211,252,.35) !important;
    color:#67e8f9 !important;
}

/* staking pool APY box */
.plan-roi{
    background:rgba(56,189,248,.08) !important;
    border:1px solid rgba(125,211,252,.20) !important;
}

/* recent transactions position fix */
.transactions-card{
    max-width:1320px !important;
    margin:24px auto 80px !important;
}

/* mobile */
@media(max-width:768px){
    .dashboard-main-content{
        padding:16px !important;
    }

    .dashboard-info-bar{
        grid-template-columns:1fr !important;
    }

    .dashboard-stats-grid,
    .dashboard-grid,
    .profile-locked-section{
        grid-template-columns:1fr !important;
    }

    .transactions-card{
        margin:18px 16px 70px !important;
    }
}
</style>
@endsection

@section('content')

@php
    $popupNotification = \App\Models\Notification::where('for', 'user')
        ->where('user_id', auth()->id())
        ->where('read', 0)
        ->latest()
        ->first();
@endphp

@if($popupNotification)
<div class="modal fade" id="userPopupNotification" tabindex="-1" aria-labelledby="userPopupNotificationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content site-table-modal">
            <div class="modal-body popup-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="popup-body-text">
                    <h3 class="title mb-3">{{ $popupNotification->title }}</h3>
                    <p style="white-space: pre-wrap;">{!! nl2br(e($popupNotification->notice)) !!}</p>
                    <a href="{{ $popupNotification->action_url }}"
                       class="site-btn-sm primary-btn mt-3">
                        {{ __('Continue') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- MODERN DASHBOARD SECTION -->
<div class="modern-dashboard-wrapper">
    <div class="dashboard-main-content">
        
        <!-- Greeting Section -->
        <div class="dashboard-greeting">
            <h1>{{ __('Good Day') }}, {{ $user->first_name }}! ðŸ‘‹</h1>
            <p>{{ __('Track your staking, manage pools, and grow decentralized.') }}</p>
        </div>

       <!-- Info Bar -->
<div class="dashboard-info-bar">
    <div class="info-item">
        <svg class="info-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6" stroke-width="2"></line>
            <line x1="8" y1="2" x2="8" y2="6" stroke-width="2"></line>
            <line x1="3" y1="10" x2="21" y2="10" stroke-width="2"></line>
        </svg>
        <div class="info-item-content">
            <h6>{{ __('Member since') }}</h6>
            <p>{{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</p>
        </div>
    </div>

    <div class="info-item">
    <svg class="info-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M22 12h-4l-3 9L9 3l-3 9H2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="info-item-content">
        <h6>{{ __('Favorite pool') }}</h6>
        <p>{{ $dataCount['favorite_pool'] ?? __('No Pool Yet') }}</p>
    </div>
</div>

    <div class="info-item">
        <svg class="info-item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
            <polyline points="12 6 12 12 16 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
        </svg>
        <div class="info-item-content">
            <h6>{{ __('Active stakes') }}</h6>
            <p>{{ $dataCount['active_investment'] ?? 0 }}</p>
        </div>
    </div>
</div>
        <!-- Stats Grid - Three Cards -->
        <div class="dashboard-stats-grid">
            <!-- Total Staked -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="12" y1="1" x2="12" y2="23" stroke-width="2" stroke-linecap="round"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div class="stat-trend">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            <polyline points="17 6 23 6 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        </svg>
                        --
                    </div>
                </div>
                <div class="stat-card-body">
                    <h6>{{ $currencySymbol }}{{ number_format($dataCount['total_investment'] ?? 0, 2) }}</h6>
                    <p>{{ __('Your Total Staked') }}</p>
                    <div class="stat-card-footer">{{ __('Across all pools') }}</div>
                </div>
            </div>

            <!-- Total Rewards Earned -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line>
                        </svg>
                    </div>
                    <div class="stat-trend">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            <polyline points="17 6 23 6 23 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        </svg>
                        --
                    </div>
                </div>
                <div class="stat-card-body">
                    <h6>{{ $currencySymbol }}{{ number_format($dataCount['total_profit'] ?? 0, 2) }}</h6>
                    <p>{{ __('Total Rewards Earned') }}</p>
                    <div class="stat-card-footer">{{ __('Lifetime earnings') }}</div>
                </div>
            </div>

            <!-- Active Stakes -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                            <circle cx="12" cy="12" r="6" stroke-width="2"></circle>
                            <circle cx="12" cy="12" r="2" stroke-width="2"></circle>
                        </svg>
                    </div>
                    <div class="stat-trend">
                        --
                    </div>
                </div>
                <div class="stat-card-body">
                    <h6>{{ $dataCount['active_investment'] ?? 0 }}</h6>
                    <p>{{ __('Active Stakes') }}</p>
                    <div class="stat-card-footer">{{ __('Currently staking') }}</div>
                </div>
            </div>
        </div>

               <!-- Main Grid: Balance + Quick Actions -->
        <div class="dashboard-grid">
            <!-- Balance Card -->
          <div class="balance-card balance-card-pro" id="usdtBalanceCard">
    <div class="balance-chart-bg">
        <svg viewBox="0 0 600 140" preserveAspectRatio="none" class="balance-chart-svg">
            <defs>
                <linearGradient id="balanceAreaGradient" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="rgba(70,185,255,0.35)" />
                    <stop offset="100%" stop-color="rgba(70,185,255,0)" />
                </linearGradient>
            </defs>
            <path id="balanceChartArea" d=""></path>
            <path id="balanceChartPath" d=""></path>
        </svg>
    </div>

    <div class="balance-card-top">
        <div class="balance-card-title-wrap">
            <h6>{{ __('Total Balance') }}</h6>
            <p class="balance-subtitle">{{ __('USDT yield linked overview') }}</p>
        </div>

        <div class="balance-apy-box">
            <span class="balance-apy-badge" id="liveUsdtApy">8.42% APY</span>
            <small class="balance-apy-note">{{ __('Live USDT APY') }}</small>
        </div>
    </div>

    <div class="balance-main-row">
        <h4 class="balance-amount">{{ $currencySymbol }}{{ number_format($user->balance, 2) }}</h4>
    </div>

    <div class="balance-updated-row">
        <span class="balance-updated-label">{{ __('Last updated') }}:</span>
        <span id="balanceLastUpdated">{{ now()->format('M d, Y h:i A') }}</span>
    </div>

    <div class="balance-secondary compact-balance-meta">
        <div class="balance-item">
            <h6>{{ __('Profit Wallet') }}</h6>
            <p>{{ $currencySymbol }}{{ number_format($user->profit_balance, 2) }}</p>
        </div>

        <div class="balance-item">
            <h6>{{ __('This Week') }}</h6>
            <p>{{ $currencySymbol }}{{ number_format($dataCount['profit_last_7_days'] ?? 0, 2) }}</p>
        </div>
    </div>
</div>

            <!-- Quick Actions - Desktop Only -->
            <div class="quick-actions-card">
                <h4>{{ __('Quick Actions') }}</h4>
                <div class="quick-actions-grid">
                    <a href="{{ route('user.invest-logs') }}" class="quick-action-btn">
                        <div class="quick-action-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-width="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9" stroke-width="2"></line>
                                <line x1="9" y1="21" x2="9" y2="9" stroke-width="2"></line>
                            </svg>
                        </div>
                        <span>{{ __('Active Pool') }}</span>
                    </a>

                    <a href="{{ route('user.wallet-exchange') }}" class="quick-action-btn">
                        <div class="quick-action-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <polyline points="7 10 12 15 17 10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line>
                            </svg>
                        </div>
                        <span>{{ __('Swap') }}</span>
                    </a>

                    <a href="{{ route('user.withdraw.view') }}" class="quick-action-btn">
                        <div class="quick-action-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <line x1="22" y1="2" x2="11" y2="13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polygon>
                            </svg>
                        </div>
                        <span>{{ __('Withdraw') }}</span>
                    </a>

                    <a href="{{ route('user.transactions') }}" class="quick-action-btn">
                        <div class="quick-action-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <line x1="12" y1="1" x2="12" y2="23" stroke-width="2" stroke-linecap="round"></line>
                                <polyline points="17 5 12 1 7 5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                                <polyline points="7 19 12 23 17 19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            </svg>
                        </div>
                        <span>{{ __('History') }}</span>
                    </a>
                </div>
            </div>
        </div>

                     <!-- MOBILE QUICK ACTIONS - Shows only on mobile -->
        <div class="mobile-quick-actions">
            <div class="mobile-quick-actions-header">
                <h4>{{ __('Quick Actions') }}</h4>
            </div>

            <div class="mobile-quick-actions-grid">
                <!-- Deposit -->
                <a href="{{ route('user.deposit.amount') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke-linecap="round" stroke-linejoin="round"></path>
                            <polyline points="7 10 12 15 17 10" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3" stroke-linecap="round" stroke-linejoin="round"></line>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('Deposit') }}</span>
                </a>

                <!-- Invest -->
                <a href="{{ route('user.schema') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('Stake Pools') }}</span>
                </a>

                <!-- Withdraw -->
                <a href="{{ route('user.withdraw.view') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="22" y1="2" x2="11" y2="13" stroke-linecap="round" stroke-linejoin="round"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2" stroke-linecap="round" stroke-linejoin="round"></polygon>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('Withdraw') }}</span>
                </a>

                <!-- History -->
                <a href="{{ route('user.transactions') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="12" y1="1" x2="12" y2="23" stroke-linecap="round"></line>
                            <polyline points="17 5 12 1 7 5" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            <polyline points="7 19 12 23 17 19" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('History') }}</span>
                </a>

                <!-- Pool History (Changed from Profile) -->
                <a href="{{ route('user.invest-logs') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('Active Pools') }}</span>
                </a>

                <!-- Referrals (Changed from Dashboard) -->
                <a href="{{ route('user.referral') }}" class="mobile-quick-action-tile">
                    <div class="mobile-action-icon-wrapper">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <span class="mobile-action-label">{{ __('Referrals') }}</span>
                </a>
            </div>
        </div>

              

              <!-- Profile & Locked Period Section -->
        <div class="profile-locked-section">
            <!-- Profile Box -->
            <div class="profile-box">
                <div class="profile-header">
                    <h4>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <circle cx="12" cy="7" r="4" stroke-width="2"></circle>
                        </svg>
                        {{ __('Your Profile') }}
                    </h4>
                    <a href="{{ route('user.setting.show') }}" class="profile-edit-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="profile-avatar-section">
                    <div class="profile-avatar">
                        @if($user->avatar && $user->avatar != 'frontend/images/user.png')
                            <img src="{{ asset($user->avatar) }}" alt="{{ $user->full_name }}">
                        @else
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}
                        @endif
                    </div>
                    <h3 class="profile-name">{{ $user->full_name }}</h3>
                </div>

                <div class="profile-info-grid">
                    <div class="profile-info-item">
                        <span class="profile-info-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke-width="2"></path>
                                <polyline points="22,6 12,13 2,6" stroke-width="2"></polyline>
                            </svg>
                            {{ __('Email') }}
                        </span>
                        <span class="profile-info-value">{{ $user->email }}</span>
                    </div>

                    <div class="profile-info-item">
                        <span class="profile-info-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6" stroke-width="2"></line>
                                <line x1="8" y1="2" x2="8" y2="6" stroke-width="2"></line>
                                <line x1="3" y1="10" x2="21" y2="10" stroke-width="2"></line>
                            </svg>
                            {{ __('Member Since') }}
                        </span>
                        <span class="profile-info-value">{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</span>
                    </div>
                </div>

                <div class="profile-achievements">
                    <div class="profile-achievements-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M4 22h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="profile-achievements-label">{{ __('Achievements') }}</span>
                    </div>
                    <div class="profile-achievements-value">{{ $dataCount['rank_achieved'] }} {{ __('unlocked') }}</div>
                    <p class="profile-achievements-text">{{ __('Keep staking to earn more achievements!') }}</p>
                </div>

                <!-- KYC Verification Status - Only show if enabled by admin -->
                @if(setting('kyc_verification', 'permission'))
                <div class="profile-kyc-status">
                    <div class="kyc-status-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 11l3 3L22 4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span class="kyc-status-label">{{ __('KYC Verification') }}</span>
                    </div>

                    @if($user->kyc == \App\Enums\KYCStatus::Verified->value)
                        <div class="kyc-status-badge verified">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <polyline points="22 4 12 14.01 9 11.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            </svg>
                            {{ __('Verified') }}
                        </div>
                        <p style="font-size: 12px; color: rgba(255, 255, 255, 0.5); margin-top: 8px; margin-bottom: 0;">
                            {{ __('Your identity has been verified') }}
                        </p>
                    @elseif($user->kyc == \App\Enums\KYCStatus::Pending->value)
                        <div class="kyc-status-badge pending">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                <polyline points="12 6 12 12 16 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                            </svg>
                            {{ __('Pending Review') }}
                        </div>
                        <p style="font-size: 12px; color: rgba(255, 255, 255, 0.5); margin-top: 8px; margin-bottom: 0;">
                            {{ __('Your verification is under review') }}
                        </p>
                    @elseif($user->kyc == \App\Enums\KYCStatus::Failed->value)
                        <div class="kyc-status-badge unverified">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                <line x1="15" y1="9" x2="9" y2="15" stroke-width="2" stroke-linecap="round"></line>
                                <line x1="9" y1="9" x2="15" y2="15" stroke-width="2" stroke-linecap="round"></line>
                            </svg>
                            {{ __('Rejected') }}
                        </div>
                        <p style="font-size: 12px; color: rgba(255, 255, 255, 0.5); margin-top: 8px; margin-bottom: 8px;">
                            {{ __('Please resubmit your documents') }}
                        </p>
                        <a href="{{ route('user.kyc') }}" class="kyc-action-link">
                            {{ __('Resubmit KYC â†’') }}
                        </a>
                    @else
                        <div class="kyc-status-badge unverified">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" stroke-linecap="round"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2" stroke-linecap="round"></line>
                            </svg>
                            {{ __('Not Verified') }}
                        </div>
                        <p style="font-size: 12px; color: rgba(255, 255, 255, 0.5); margin-top: 8px; margin-bottom: 8px;">
                            {{ __('Verify your identity to unlock all features') }}
                        </p>
                        <a href="{{ route('user.kyc') }}" class="kyc-action-link">
                            {{ __('Complete KYC Verification â†’') }}
                        </a>
                    @endif
                </div>
                @endif
                <!-- End KYC Section -->

            </div>
            <!-- End Profile Box -->

            <!-- Locked Period Box -->
            <div class="locked-period-box">
                @if($latestInvestment)
                    <div class="locked-period-header">
                        <h4 class="locked-period-title">{{ __('Lock Period') }}</h4>
                        <p class="locked-period-subtitle">{{ $latestInvestment->schema->name }}</p>
                    </div>

                    <div class="locked-period-countdown">
                        @php
                            $now = \Carbon\Carbon::now();
                            $endDate = \Carbon\Carbon::parse($latestInvestment->next_profit_time);
                            $startDate = \Carbon\Carbon::parse($latestInvestment->created_at);
                            $endTimestamp = $endDate->timestamp;
                            $startTimestamp = $startDate->timestamp;
                            $totalDuration = $startTimestamp ? ($endTimestamp - $startTimestamp) : 0;
                            $elapsed = $now->timestamp - $startTimestamp;
                            $remaining = $endTimestamp - $now->timestamp;
                            $progressPercentage = $totalDuration > 0 ? min(100, max(0, ($elapsed / $totalDuration) * 100)) : 0;
                            $days = max(0, floor($remaining / 86400));
                            $hours = max(0, floor(($remaining % 86400) / 3600));
                            $minutes = max(0, floor(($remaining % 3600) / 60));
                            $seconds = max(0, $remaining % 60);
                        @endphp

                        <div class="countdown-timer" id="lockPeriodCountdown" 
                             data-end-time="{{ $endTimestamp }}"
                             data-start-time="{{ $startTimestamp }}">
                            <div class="countdown-item">
                                <div class="countdown-value" id="days-countdown">{{ $days }}</div>
                                <div class="countdown-label">{{ __('Days') }}</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value" id="hours-countdown">{{ str_pad($hours, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="countdown-label">{{ __('Hours') }}</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value" id="minutes-countdown">{{ str_pad($minutes, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="countdown-label">{{ __('Mins') }}</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value" id="seconds-countdown">{{ str_pad($seconds, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="countdown-label">{{ __('Secs') }}</div>
                            </div>
                        </div>

                        <div class="locked-period-progress">
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar-fill" id="lockProgressBar" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                            <p class="progress-text">
                                <span id="progressPercentage">{{ number_format($progressPercentage, 1) }}</span>% {{ __('Complete') }}
                            </p>
                        </div>
                    </div>

                    <div class="locked-period-stats">
                        <div class="locked-stat">
                            {{ __('Stake Amount:') }} 
                            <span class="locked-stat-value">{{ $currencySymbol }}{{ number_format($latestInvestment->invest_amount, 2) }}</span>
                        </div>
                        <div class="locked-stat">
                            {{ __('Return Period:') }} 
                            <span class="locked-stat-value">
                                {{ $latestInvestment->schema->schedule->name ?? __('N/A') }}
                            </span>
                        </div>
                        <div class="locked-stat">
                            {{ __('Profit Earned:') }} 
                            <span class="locked-stat-value">{{ $currencySymbol }}{{ number_format($latestInvestment->total_profit_amount ?? 0, 2) }}</span>
                        </div>
                    </div>
                @else
                    <div class="no-active-stakes">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="5" y="11" width="14" height="10" rx="2" stroke-width="2"></rect>
                            <path d="M12 11V7" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M8 7h8" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                        <h5>{{ __('No active stakes') }}</h5>
                        <p>{{ __('Start staking to see lock period') }}</p>
                        <div class="total-staked">{{ __('Total Staked') }}</div>
                        <div class="total-staked-amount">{{ $currencySymbol }}{{ number_format($dataCount['total_investment'], 2) }}</div>
                        <div class="progress-bar-wrapper">
                            <div class="progress-bar-fill" style="width: 0%"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Profile & Locked Period Section -->


<!-- Top Staking Pools / Yield Trend -->
<div class="top-pools-section">
    <div class="top-pools-card">
        <div class="top-pools-header">
            <div class="top-pools-header-left">
                <div class="top-pools-title-row">
                    <h4>{{ __('Top Staking Pools') }}</h4>
                    <span class="top-pools-live">
                        <span class="live-dot"></span>
                        {{ __('Live') }}
                    </span>
                </div>
                <p>{{ __('30-day yield chart (average APY index)') }}</p>
            </div>

            <div class="top-pools-header-right">
                <div id="pools-status" class="top-pools-status">{{ __('Data: Live') }}</div>
                <button id="pools-reload" type="button" class="top-pools-refresh-btn">
                    <span class="refresh-dot"></span>
                    {{ __('Refresh') }}
                </button>
            </div>
        </div>

        <div class="top-pools-grid">
            <!-- left -->
            <div class="top-pools-chart-card">
                <div class="top-pools-chart-head">
                    <span>{{ __('APY Index (30d)') }}</span>
                    <div class="mini-eq">
                        @for($i = 0; $i < 14; $i++)
                            <span style="height: {{ 8 + ($i % 5) * 5 }}px"></span>
                        @endfor
                    </div>
                </div>

                <div class="top-pools-chart-wrap">
                    <div id="pools-loading" class="top-pools-loading">{{ __('Loading pools...') }}</div>
                    <div id="apy-chart" class="apy-chart-bars"></div>
                </div>

                <div class="top-pools-chart-meta">
                    <span id="apy-min">{{ __('Min: --%') }}</span>
                    <span id="apy-max">{{ __('Max: --%') }}</span>
                </div>
            </div>

            <!-- right -->
            <div class="top-pools-list-card">
                <div class="top-pools-list-head">
                    <span>{{ __('Top pools') }}</span>
                    <span>{{ __('(24h)') }}</span>
                </div>

                <div id="pools-rows" class="top-pools-rows">
                    <!-- injected by js -->
                </div>
            </div>
        </div>
    </div>

    <div class="pool-trend-card">
        <div class="pool-trend-head">
            <div class="pool-trend-title">
                {{ __('Pool Yield Trend (30d)') }}
                <span>{{ __('(avg APY of top pools)') }}</span>
            </div>
            <div id="trendMeta" class="pool-trend-meta">{{ __('Waiting...') }}</div>
        </div>

        <div class="pool-trend-body">
            <div class="pool-trend-canvas-wrap">
                <canvas id="poolsTrendChart"></canvas>
                <div id="poolsTrendLoading" class="pool-trend-loading">{{ __('Loading pool trend...') }}</div>
                <div id="poolsTrendError" class="pool-trend-error">{{ __('Failed to load trend.') }}</div>
            </div>

            <div class="pool-trend-stats">
                <div class="pool-trend-stat">
                    <div class="stat-label">{{ __('Avg APY (30d)') }}</div>
                    <div id="avgApy30" class="stat-value">—</div>
                </div>
                <div class="pool-trend-stat">
                    <div class="stat-label">{{ __('Best Pool') }}</div>
                    <div id="bestPoolName" class="stat-value small">—</div>
                </div>
                <div class="pool-trend-stat">
                    <div class="stat-label">{{ __('Top Pool APY') }}</div>
                    <div id="bestPoolApy" class="stat-value">—</div>
                </div>
                <div class="pool-trend-stat">
                    <div class="stat-label">{{ __('Total TVL') }}</div>
                    <div id="totalTvl" class="stat-value">—</div>
                </div>
            </div>
        </div>
    </div>
</div>






        <!-- Staking Plans Section -->
        <div class="staking-plans-section">
            <div class="staking-plans-header">
                <h3>{{ __('Available Staking Pools') }}</h3>
            </div>

            @if($schemas && $schemas->count() > 0)
            <div class="staking-plans-slider">
                <div class="swiper stakingPlansSwiper">
                    <div class="swiper-wrapper">
                        @foreach($schemas as $schema)                                        <div class="swiper-slide">
                            <div class="staking-plan-card">
                                <!-- Plan Header -->
                                <div class="plan-card-header">
                                    <div class="plan-icon-wrapper">
                                        @if($schema->icon)
                                            <img src="{{ asset($schema->icon) }}" alt="{{ $schema->name }}">
                                        @else
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" width="32" height="32">
                                                <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#c8ff00"></circle>
                                                <path d="M12 6v6l4 2" stroke-width="2" stroke="#c8ff00" stroke-linecap="round"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="plan-title-section">
                                        <h5 class="plan-title">{{ $schema->name }}</h5>
                                        @if($schema->badge)
                                            <span class="plan-badge">{{ $schema->badge }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- ROI Display -->
                                <div class="plan-roi">
                                    <div class="plan-roi-label">{{ __('APY') }}</div>
                                    <div class="plan-roi-value">
                                        @if($schema->interest_type == 'percentage')
                                            {{ $schema->return_interest }}%
                                        @else
                                            {{ $currencySymbol }}{{ $schema->return_interest }}
                                        @endif
                                    </div>
                                    
                                </div>

                                <!-- Plan Details -->
                                <div class="plan-details">
                                    <div class="plan-detail-row">
                                        <span class="plan-detail-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <line x1="12" y1="1" x2="12" y2="23" stroke-width="2"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" stroke-width="2"></path>
                                            </svg>
                                            {{ $schema->type == 'range' ? __('Min Stake') : __('Amount') }}
                                        </span>
                                        <span class="plan-detail-value">
                                            @if($schema->type == 'range')
                                                {{ $currencySymbol }}{{ number_format($schema->min_amount, 2) }}
                                            @else
                                                {{ $currencySymbol }}{{ number_format($schema->fixed_amount, 2) }}
                                            @endif
                                        </span>
                                    </div>

                                    @if($schema->type == 'range')
                                    <div class="plan-detail-row">
                                        <span class="plan-detail-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <line x1="12" y1="1" x2="12" y2="23" stroke-width="2"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" stroke-width="2"></path>
                                            </svg>
                                            {{ __('Max Stake') }}
                                        </span>
                                        <span class="plan-detail-value">
                                            {{ $currencySymbol }}{{ number_format($schema->max_amount, 2) }}
                                        </span>
                                    </div>
                                    @endif

                                    <div class="plan-detail-row">
                                        <span class="plan-detail-label">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                                <polyline points="12 6 12 12 16 14" stroke-width="2"></polyline>
                                            </svg>
                                            {{ __('Locked Period') }}
                                        </span>
                                        <span class="plan-detail-value">
                                            @if($schema->return_type == 'period')
                                                {{ $schema->number_of_period }} {{ $schema->number_of_period == 1 ? __('Time') : __('Days') }}
                                            @else
                                                {{ __('Unlimited') }}
                                            @endif
                                        </span>
                                    </div>

                                  
                                </div>

                                <!-- Action Button -->
                                <a href="{{ route('user.schema.preview', $schema->id) }}" class="plan-action-btn">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M5 12h14M12 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    {{ __('Stake Now') }}
                                </a>
                            </div>
                            
                            
                            
                        </div>
                        
                        
                        @endforeach
                        
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            @else
            
            
            <!-- Empty State -->
            <div class="no-plans-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                    <line x1="12" y1="8" x2="12" y2="12" stroke-width="2" stroke-linecap="round"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16" stroke-width="2" stroke-linecap="round"></line>
                </svg>
                <h5>{{ __('No Staking Pools Available') }}</h5>
                <p>{{ __('Check back later for new staking opportunities') }}</p>
            </div>
            @endif
            
        </div>


               <!-- Recent Transactions -->
        <div class="transactions-card">
            <div class="transactions-header">
                <h4>{{ __('Recent Transactions') }}</h4>
            </div>

            @if($recentTransactions && $recentTransactions->count() > 0)
            <table class="transactions-table">
                <thead>
                    <tr>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Transaction ID') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions->take(5) as $transaction)
                    <tr>
                        <td>{{ $transaction->description }}</td>
                        <td class="transaction-id">{{ $transaction->tnx }}</td>
                        <td>{{ $transaction->method }}</td>
                        <td class="transaction-amount {{ txn_type($transaction->type->value, ['positive', 'negative'], 'hardrock') }}">
                            {{ txn_type($transaction->type->value, ['+', '-'], 'hardrock') }}{{ $currencySymbol }}{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td>
                            @if($transaction->status->value == 'pending')
                                <span class="transaction-status pending">{{ __('Pending') }}</span>
                            @elseif($transaction->status->value == 'success')
                                <span class="transaction-status success">{{ __('Success') }}</span>
                            @else
                                <span class="transaction-status failed">{{ __('Failed') }}</span>
                            @endif
                        </td>
                       <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- View All Button - Bottom Center -->
            <div class="transactions-footer">
                <a href="{{ route('user.transactions') }}" class="view-all-btn">
                    {{ __('View All Activity') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <line x1="5" y1="12" x2="19" y2="12" stroke-width="2" stroke-linecap="round"></line>
                        <polyline points="12 5 19 12 12 19" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></polyline>
                    </svg>
                </a>
            </div>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <rect x="3" y="8" width="18" height="4" rx="1" stroke-width="2"></rect>
                    <rect x="3" y="4" width="18" height="4" rx="1" stroke-width="2"></rect>
                    <rect x="3" y="12" width="18" height="4" rx="1" stroke-width="2"></rect>
                    <rect x="3" y="16" width="18" height="4" rx="1" stroke-width="2"></rect>
                </svg>
                <p>{{ __('No transactions yet. Start Staking to see your activity here!') }}</p>
            </div>
            @endif
        </div>

    </div>
</div>

<br><br>
<!-- ORIGINAL CONTENT BELOW (CHARTS, CALCULATORS, ETC.) -->
<!--<div class="container-fluid default-page" style="background: transparent;">-->
    
    <!-- Mobile Screen Content -->
<!--    <div class="rock-mobile-screen-show">-->
        <!-- Crypto Staking Plan Chart Section -->
<!--        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->

        <!-- Chart Container -->
<!--        <div class="card text-white shadow mb-4" style="background-color: #6337e617;">-->
<!--            <div class="card-header border-bottom">-->
<!--                <h5 class="mb-0">Top 10 Staking Protocols (Live TVL)</h5>-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <div style="position:relative; height:400px; width:100%;">-->
<!--                    <canvas id="stakingBarChart" style="background-color: #6337e617; border-radius: 10px;"></canvas>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        <script>-->
<!--            async function loadStakingBarChart() {-->
<!--                const canvas = document.getElementById('stakingBarChart');-->
<!--                if (!canvas) return;-->

<!--                const ctx = canvas.getContext('2d');-->

<!--                try {-->
<!--                    const res = await fetch('https://api.llama.fi/protocols');-->
<!--                    const data = await res.json();-->

<!--                    const stakingData = data-->
<!--                        .filter(p => p.category && p.category.toLowerCase().includes("staking"))-->
<!--                        .sort((a, b) => b.tvl - a.tvl)-->
<!--                        .slice(0, 10);-->

<!--                    const labels = stakingData.map(p => p.name);-->
<!--                    const tvls = stakingData.map(p => p.tvl);-->

<!--                    new Chart(ctx, {-->
<!--                        type: 'bar',-->
<!--                        data: {-->
<!--                            labels: labels,-->
<!--                            datasets: [{-->
<!--                                label: 'TVL (USD)',-->
<!--                                data: tvls,-->
<!--                                backgroundColor: 'rgba(0, 123, 255, 0.7)',-->
<!--                                borderColor: 'rgba(0, 123, 255, 1)',-->
<!--                                borderWidth: 1,-->
<!--                                borderRadius: 4-->
<!--                            }]-->
<!--                        },-->
<!--                        options: {-->
<!--                            maintainAspectRatio: false,-->
<!--                            responsive: true,-->
<!--                            plugins: {-->
<!--                                legend: {-->
<!--                                    labels: {-->
<!--                                        color: '#ffffff'-->
<!--                                    }-->
<!--                                },-->
<!--                                tooltip: {-->
<!--                                    callbacks: {-->
<!--                                        label: context => `$${context.parsed.y.toLocaleString()}`-->
<!--                                    }-->
<!--                                }-->
<!--                            },-->
<!--                            scales: {-->
<!--                                x: {-->
<!--                                    ticks: { color: '#ccc' },-->
<!--                                    grid: { color: 'rgba(255,255,255,0.1)' }-->
<!--                                },-->
<!--                                y: {-->
<!--                                    beginAtZero: true,-->
<!--                                    ticks: {-->
<!--                                        color: '#ccc',-->
<!--                                        callback: value => '$' + value.toLocaleString()-->
<!--                                    },-->
<!--                                    grid: { color: 'rgba(255,255,255,0.1)' }-->
<!--                                }-->
<!--                            }-->
<!--                        }-->
<!--                    });-->
<!--                } catch (error) {-->
<!--                    console.error("Error loading staking bar chart:", error);-->
<!--                }-->
<!--            }-->

<!--            document.addEventListener("DOMContentLoaded", loadStakingBarChart);-->
<!--        </script>-->

        <!-- Yield Projection Calculator -->
<!--        <script src="https://s3.tradingview.com/tv.js"></script>-->

<!--        <style>-->
<!--            .stake-calculator {-->
<!--                font-family: Arial, sans-serif;-->
<!--                background-color: #6337e617;-->
<!--                color: #fff;-->
<!--                padding: 1rem;-->
<!--                margin: 2rem auto;-->
<!--                max-width: 1200px;-->
<!--                border-radius: 10px;-->
<!--            }-->
<!--            .stake-calculator h5 {-->
<!--                text-align: center;-->
<!--                margin-bottom: 1rem;-->
<!--            }-->
<!--            .stake-calculator .input-section {-->
<!--                display: flex;-->
<!--                flex-direction: column;-->
<!--                gap: 1rem;-->
<!--                margin-bottom: 1rem;-->
<!--            }-->
<!--            .stake-calculator label {-->
<!--                font-weight: bold;-->
<!--            }-->
<!--            .stake-calculator input[type="number"] {-->
<!--                padding: 0.6rem;-->
<!--                border-radius: 5px;-->
<!--                border: none;-->
<!--                font-size: 1rem;-->
<!--                width: 100%;-->
<!--            }-->
<!--            .stake-calculator button,-->
<!--            .stake-calculator a {-->
<!--                background-color: #075dba;-->
<!--                color: #fff;-->
<!--                border: none;-->
<!--                padding: 0.8rem;-->
<!--                border-radius: 5px;-->
<!--                font-size: 1rem;-->
<!--                cursor: pointer;-->
<!--                font-weight: bold;-->
<!--                text-decoration: none;-->
<!--                display: inline-block;-->
<!--            }-->
<!--            .stake-calculator button:hover {-->
<!--                background-color: #064fa0;-->
<!--            }-->
<!--            .stake-calculator #results,-->
<!--            .stake-calculator #chartSection {-->
<!--                display: none;-->
<!--                margin-top: 2rem;-->
<!--            }-->
<!--            .stake-calculator canvas {-->
<!--                background-color: #6337e617;-->
<!--                border-radius: 8px;-->
<!--                width: 100% !important;-->
<!--                height: auto !important;-->
<!--            }-->
<!--        </style>-->

<!--        <div class="stake-calculator">-->
<!--            <h5>Yield Projection</h5>-->
<!--            <div class="input-section">-->
<!--                <label for="amount">Staking Amount ($):</label>-->
<!--                <input type="number" id="amount" placeholder="e.g., 10000" min="50" />-->
<!--                <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">-->
<!--                    <button onclick="simulate()">Calculate</button>-->
<!--                    <a href="{{ route('user.schema') }}">Stake Now</a>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div id="results"></div>-->

<!--            <div id="chartSection">-->
<!--                <canvas id="earningsChart"></canvas>-->
<!--            </div>-->

<!--            <button onclick="closeChart()" style="margin-top: 1rem; background-color: #444; color: #fff;">Close Chart</button>-->
<!--        </div>-->

<!--        <script>-->
<!--            const plans = [-->
<!--                { name: "MinxChain DAO Smart Contract", rate: 1.2, min: 50, max: 999 },-->
<!--                { name: "MinxChain Boost", rate: 3.2, min: 1000, max: 4999 },-->
<!--                { name: "MinxChain DAO-farming", rate: 5.2, min: 5000, max: 9999 },-->
<!--                { name: "MinxChain -IDOs", rate: 7.2, min: 10000, max: 49999 },-->
<!--                { name: "Meme-pool DAO", rate: 9.5, min: 50000, max: 499999 },-->
<!--                { name: "DCA Staking", rate: 10.5, min: 500000, max: 1000000 }-->
<!--            ];-->

<!--            let chart;-->

<!--            function simulate() {-->
<!--                const amount = parseFloat(document.getElementById("amount").value);-->
<!--                const resultDiv = document.getElementById("results");-->
<!--                const chartSection = document.getElementById("chartSection");-->

<!--                if (isNaN(amount) || amount < 50) {-->
<!--                    alert("Please enter a valid amount (minimum $50)");-->
<!--                    return;-->
<!--                }-->

<!--                const plan = plans.find(p => amount >= p.min && amount <= p.max);-->
<!--                if (!plan) {-->
<!--                    alert("No matching plan found for the entered amount.");-->
<!--                    return;-->
<!--                }-->

<!--                const dailyRate = plan.rate / 100;-->
<!--                const earnings = [];-->
<!--                let capital = amount;-->

<!--                for (let i = 1; i <= 5; i++) {-->
<!--                    capital += capital * dailyRate;-->
<!--                    earnings.push(capital.toFixed(2));-->
<!--                }-->

<!--                resultDiv.innerHTML = `-->
<!--                    <h4>Stake: ${plan.name}</h4>-->
<!--                    <p>Daily Rate: ${plan.rate}%</p>-->
<!--                    <p>Total Returns 3-5 Days: $${capital.toFixed(2)}</p>-->
<!--                `;-->
<!--                resultDiv.style.display = "block";-->
<!--                chartSection.style.display = "block";-->

<!--                const ctx = document.getElementById("earningsChart").getContext("2d");-->
<!--                if (chart) chart.destroy();-->

<!--                chart = new Chart(ctx, {-->
<!--                    type: 'line',-->
<!--                    data: {-->
<!--                        labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5"],-->
<!--                        datasets: [{-->
<!--                            label: 'Capital Growth',-->
<!--                            data: earnings,-->
<!--                            fill: true,-->
<!--                            borderColor: '#075dba',-->
<!--                            backgroundColor: 'rgba(0, 255, 204, 0.1)',-->
<!--                            tension: 0.3-->
<!--                        }]-->
<!--                    },-->
<!--                    options: {-->
<!--                        responsive: true,-->
<!--                        plugins: {-->
<!--                            legend: {-->
<!--                                labels: { color: '#fff' }-->
<!--                            }-->
<!--                        },-->
<!--                        scales: {-->
<!--                            x: {-->
<!--                                ticks: { color: '#fff' }-->
<!--                            },-->
<!--                            y: {-->
<!--                                ticks: { color: '#fff' }-->
<!--                            }-->
<!--                        }-->
<!--                    }-->
<!--                });-->
<!--            }-->

<!--            function closeChart() {-->
<!--                document.getElementById("results").style.display = "none";-->
<!--                document.getElementById("chartSection").style.display = "none";-->
<!--                document.getElementById("amount").value = "";-->
<!--            }-->
<!--        </script>-->
<!--    </div>-->

<!--</div>-->
@endsection

@section('script')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

@if($popupNotification)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let modal = new bootstrap.Modal(document.getElementById('userPopupNotification'));
        modal.show();

        document.getElementById('userPopupNotification')
            .addEventListener('hidden.bs.modal', function () {
                fetch("{{ route('user.read-notification', $popupNotification->id) }}");
            });
    });
</script>
@endif

<script>
    console.log('=== SCRIPT SECTION LOADED ===');
    console.log('jQuery loaded?', typeof jQuery !== 'undefined');
    console.log('$ loaded?', typeof $ !== 'undefined');
</script>

<script>
    (function() {
        'use strict';
        
        // Wait for DOM and Swiper to be ready
        if (typeof Swiper === 'undefined') {
            console.error('Swiper is not loaded!');
            return;
        }
        
        // Initialize Staking Plans Swiper
        const initStakingSwiper = () => {
            const swiperElement = document.querySelector('.stakingPlansSwiper');
            
            if (!swiperElement) {
                console.log('Swiper element not found');
                return;
            }
            
            const stakingSwiper = new Swiper(".stakingPlansSwiper", {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: false,
                grabCursor: true,
                
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 24
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24
                    }
                },
                
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                effect: 'slide',
                speed: 600,
                
                keyboard: {
                    enabled: true,
                },
                
                a11y: {
                    enabled: true,
                },
                
                observer: true,
                observeParents: true,
            });
            
            console.log('Swiper initialized successfully!');
        };
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initStakingSwiper);
        } else {
            initStakingSwiper();
        }
        
    })();
</script>

<!-- COUNTDOWN TIMER SCRIPT -->
<script>
    console.log('Countdown script loading...');
    
    // Bulletproof Live Countdown Timer
    (function() {
        'use strict';
        
        console.log('Countdown IIFE started');
        
        const countdownElement = document.getElementById('lockPeriodCountdown');
        
        console.log('Countdown element:', countdownElement);
        
        if (!countdownElement) {
            console.log('No countdown element found - no active investment');
            return;
        }
        
        const endTime = parseInt(countdownElement.getAttribute('data-end-time'));
        const startTime = parseInt(countdownElement.getAttribute('data-start-time'));
        
        console.log('Timestamps:', { startTime, endTime });
        
        const daysEl = document.getElementById('days-countdown');
        const hoursEl = document.getElementById('hours-countdown');
        const minutesEl = document.getElementById('minutes-countdown');
        const secondsEl = document.getElementById('seconds-countdown');
        const progressBar = document.getElementById('lockProgressBar');
        const progressPercentage = document.getElementById('progressPercentage');
        
        console.log('Elements:', { daysEl, hoursEl, minutesEl, secondsEl });
        
        let timerInterval = null;
        
        function updateCountdown() {
            const now = Math.floor(Date.now() / 1000);
            const remaining = endTime - now;
            
            console.log('Update:', new Date().toLocaleTimeString(), 'Remaining:', remaining);
            
            if (remaining <= 0) {
                daysEl.textContent = '0';
                hoursEl.textContent = '00';
                minutesEl.textContent = '00';
                secondsEl.textContent = '00';
                progressBar.style.width = '100%';
                progressPercentage.textContent = '100.0';
                
                if (timerInterval) {
                    clearInterval(timerInterval);
                }
                
                console.log('Countdown finished!');
                return;
            }
            
            const days = Math.floor(remaining / 86400);
            const hours = Math.floor((remaining % 86400) / 3600);
            const minutes = Math.floor((remaining % 3600) / 60);
            const seconds = remaining % 60;
            
            daysEl.textContent = days;
            hoursEl.textContent = hours.toString().padStart(2, '0');
            minutesEl.textContent = minutes.toString().padStart(2, '0');
            secondsEl.textContent = seconds.toString().padStart(2, '0');
            
            const totalDuration = endTime - startTime;
            const elapsed = now - startTime;
            const progress = Math.min(100, Math.max(0, (elapsed / totalDuration) * 100));
            
            progressBar.style.width = progress.toFixed(1) + '%';
            progressPercentage.textContent = progress.toFixed(1);
        }
        
        console.log('Starting countdown...');
        updateCountdown();
        
        timerInterval = setInterval(function() {
            updateCountdown();
        }, 1000);
        
        console.log('Timer interval started:', timerInterval);
        
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                console.log('Page visible - updating');
                updateCountdown();
            }
        });
        
        window.addEventListener('focus', function() {
            console.log('Window focused');
            updateCountdown();
        });
        
        window.addEventListener('beforeunload', function() {
            if (timerInterval) {
                clearInterval(timerInterval);
            }
        });
        
        console.log('Countdown initialized!', {
            startTime: startTime,
            endTime: endTime,
            startDate: new Date(startTime * 1000).toLocaleString(),
            endDate: new Date(endTime * 1000).toLocaleString()
        });
        
    })();
</script>

<!-- DEBUG TIMESTAMPS -->
<script>
    (function() {
        const countdownElement = document.getElementById('lockPeriodCountdown');
        if (!countdownElement) {
            console.log('DEBUG: No countdown element');
            return;
        }
        
        const endTime = parseInt(countdownElement.getAttribute('data-end-time'));
        const startTime = parseInt(countdownElement.getAttribute('data-start-time'));
        const nowTimestamp = Math.floor(Date.now() / 1000);
        
        console.log('=== COUNTDOWN DEBUG INFO ===');
        console.log('Server Start Time:', startTime, 'â†’', new Date(startTime * 1000).toLocaleString());
        console.log('Server End Time:', endTime, 'â†’', new Date(endTime * 1000).toLocaleString());
        console.log('Browser Current Time:', nowTimestamp, 'â†’', new Date(nowTimestamp * 1000).toLocaleString());
        console.log('Remaining Seconds:', endTime - nowTimestamp);
        console.log('Total Duration:', endTime - startTime, 'seconds');
        console.log('============================');
    })();
</script>

<!-- Load More buttons -->
<script>
    (function($) {
        'use strict';
        
        $('.rock-moreless-button').click(function () {
            $('.moretext').slideToggle();
            if ($('.rock-moreless-button').text() == "Load more") {
                $(this).text("Load less")
            } else {
                $(this).text("Load more")
            }
        });

        $('.rock-moreless-button-2').click(function () {
            let moreText = $('.moretext-2');
            let button = $(this);

            if (moreText.css('display') === 'none') {
                moreText.css('display', 'flex').hide();
                moreText.stop().slideDown('slow', function () {
                    $(this).css('height', 'auto');
                });
                button.text("Load less");
            } else {
                moreText.stop().slideUp('slow', function () {
                    $(this).css('display', 'none');
                });
                button.text("Load more");
            }
        });
        
    })(jQuery);
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const apyEl = document.getElementById('liveUsdtApy');
    const updatedEl = document.getElementById('balanceLastUpdated');
    const pathEl = document.getElementById('balanceChartPath');
    const areaEl = document.getElementById('balanceChartArea');

    function makeRandomPath() {
    const pathEl = document.getElementById('balanceChartPath');
    const areaEl = document.getElementById('balanceChartArea');

    if (!pathEl || !areaEl) return;

    const width = 600;
    const baseY = 135;
    const points = 13;
    const step = width / (points - 1);

    let y = 80;
    let lineD = '';
    let areaD = '';
    const coords = [];

    for (let i = 0; i < points; i++) {
        const x = i * step;

        y += (Math.random() - 0.5) * 70;

        if (Math.random() > 0.65) {
            y += (Math.random() > 0.5 ? 1 : -1) * (25 + Math.random() * 35);
        }

        y = Math.max(14, Math.min(116, y));
        coords.push({ x, y });
    }

    coords.forEach((p, i) => {
        lineD += (i === 0 ? `M ${p.x} ${p.y}` : ` L ${p.x} ${p.y}`);
    });

    areaD = `M ${coords[0].x} ${baseY}`;
    coords.forEach((p) => {
        areaD += ` L ${p.x} ${p.y}`;
    });
    areaD += ` L ${coords[coords.length - 1].x} ${baseY} Z`;

    pathEl.setAttribute('d', lineD);
    areaEl.setAttribute('d', areaD);
}
    async function loadUsdtApy() {
        try {
            const res = await fetch("{{ route('user.usdt-apy') }}", {
                headers: { 'Accept': 'application/json' }
            });

            if (!res.ok) throw new Error('Failed to fetch APY');

            const data = await res.json();
            console.log('APY response:', data);

            if (typeof data.apy !== 'undefined' && data.apy !== null) {
                apyEl.textContent = `${parseFloat(data.apy).toFixed(2)}% APY`;
            }

            const now = new Date();
            updatedEl.textContent = now.toLocaleString([], {
                month: 'short',
                day: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        } catch (err) {
            console.error(err);
            apyEl.textContent = '8.42% APY';
        }
    }

    makeRandomPath();
    loadUsdtApy();

    setInterval(makeRandomPath, 5000);
    setInterval(loadUsdtApy, 60000);
});
</script>

<script>
(function () {
    const statusEl = document.getElementById('pools-status');
    const rowsEl = document.getElementById('pools-rows');
    const chartEl = document.getElementById('apy-chart');
    const loadingEl = document.getElementById('pools-loading');
    const minEl = document.getElementById('apy-min');
    const maxEl = document.getElementById('apy-max');
    const reloadBtn = document.getElementById('pools-reload');

    const trendCanvas = document.getElementById('poolsTrendChart');
    const trendLoading = document.getElementById('poolsTrendLoading');
    const trendError = document.getElementById('poolsTrendError');
    const avgApy30 = document.getElementById('avgApy30');
    const bestPoolName = document.getElementById('bestPoolName');
    const bestPoolApy = document.getElementById('bestPoolApy');
    const totalTvl = document.getElementById('totalTvl');
    const trendMeta = document.getElementById('trendMeta');

    if (!statusEl || !rowsEl || !chartEl || !loadingEl || !trendCanvas) return;

    let inFlight = false;
    let lastGood = null;

    function fmtMoney(n) {
        const num = Number(n || 0);
        if (num >= 1e9) return (num / 1e9).toFixed(1) + "B";
        if (num >= 1e6) return (num / 1e6).toFixed(1) + "M";
        if (num >= 1e3) return (num / 1e3).toFixed(1) + "K";
        return String(Math.round(num));
    }

    function renderPools(pools) {
        rowsEl.innerHTML = "";

        pools.forEach((p) => {
            const change = Number(p.change24h ?? 0);
            const isUp = change >= 0;

            rowsEl.insertAdjacentHTML("beforeend", `
                <div class="top-pool-row">
                    <div class="min-w-0">
                        <div class="top-pool-name">${p.name}</div>
                        <div class="top-pool-meta">${p.symbol} • TVL ${fmtMoney(p.tvl)}</div>
                    </div>
                    <div class="shrink-0">
                        <div class="top-pool-apy">${Number(p.apy).toFixed(2)}% APY</div>
                        <div class="top-pool-change ${isUp ? 'up' : 'down'}">
                            ${isUp ? '+' : ''}${change.toFixed(2)}%
                        </div>
                    </div>
                </div>
            `);
        });
    }

    function renderMiniChart(series) {
        const arr = (Array.isArray(series) ? series : []).slice(-30).map(Number);
        if (!arr.length) return;

        const min = Math.min(...arr);
        const max = Math.max(...arr);
        const range = Math.max(0.0001, max - min);

        minEl.textContent = `Min: ${min.toFixed(2)}%`;
        maxEl.textContent = `Max: ${max.toFixed(2)}%`;

        chartEl.innerHTML = arr.map(v => {
            const h = 12 + Math.round(((v - min) / range) * 82);
            return `<div style="height:${h}%"></div>`;
        }).join("");
    }

    function drawAreaLineChart(canvas, points) {
        const ctx = canvas.getContext("2d");
        const dpr = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();

        canvas.width = Math.floor(rect.width * dpr);
        canvas.height = Math.floor(rect.height * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        const w = rect.width;
        const h = rect.height;
        ctx.clearRect(0, 0, w, h);

        ctx.globalAlpha = 0.18;
        ctx.strokeStyle = "rgba(255,255,255,0.12)";
        ctx.lineWidth = 1;

        for (let i = 1; i < 6; i++) {
            const y = (h / 6) * i;
            ctx.beginPath();
            ctx.moveTo(0, y);
            ctx.lineTo(w, y);
            ctx.stroke();
        }

        ctx.globalAlpha = 1;

        if (!points || points.length < 2) return;

        const min = Math.min(...points);
        const max = Math.max(...points);
        const pad = (max - min) * 0.15 || 1;
        const ymin = min - pad;
        const ymax = max + pad;
        const xStep = w / (points.length - 1);

        const toXY = (i, v) => {
            const x = i * xStep;
            const t = (v - ymin) / (ymax - ymin);
            const y = h - t * h;
            return { x, y };
        };

        ctx.beginPath();
        let p0 = toXY(0, points[0]);
        ctx.moveTo(p0.x, p0.y);

        for (let i = 1; i < points.length; i++) {
            const p = toXY(i, points[i]);
            ctx.lineTo(p.x, p.y);
        }

        ctx.lineTo(w, h);
        ctx.lineTo(0, h);
        ctx.closePath();

        const grad = ctx.createLinearGradient(0, 0, 0, h);
        grad.addColorStop(0, "rgba(34,197,94,0.22)");
        grad.addColorStop(1, "rgba(34,197,94,0.02)");
        ctx.fillStyle = grad;
        ctx.fill();

        ctx.beginPath();
        p0 = toXY(0, points[0]);
        ctx.moveTo(p0.x, p0.y);

        for (let i = 1; i < points.length; i++) {
            const p = toXY(i, points[i]);
            ctx.lineTo(p.x, p.y);
        }

        ctx.strokeStyle = "rgba(34,197,94,0.95)";
        ctx.lineWidth = 2;
        ctx.shadowBlur = 12;
        ctx.shadowColor = "rgba(34,197,94,0.40)";
        ctx.stroke();
        ctx.shadowBlur = 0;

        const last = toXY(points.length - 1, points[points.length - 1]);
        ctx.beginPath();
        ctx.arc(last.x, last.y, 3.5, 0, Math.PI * 2);
        ctx.fillStyle = "rgba(34,197,94,1)";
        ctx.fill();
    }

    async function loadTopPools() {
        if (inFlight) return;
        inFlight = true;

        loadingEl.style.display = 'flex';
        trendLoading.style.display = 'flex';
        trendError.style.display = 'none';
        statusEl.textContent = 'Data: Live';

        try {
            const res = await fetch("{{ route('dao.pools.live') }}?t=" + Date.now(), {
                headers: { "Accept": "application/json" },
                cache: "no-store"
            });

            const data = await res.json();
            if (!res.ok || !data) throw new Error("Bad response");

            const pools = Array.isArray(data.pools) ? data.pools : (Array.isArray(data.data) ? data.data : []);
            if (!pools.length) throw new Error("No pools");

            lastGood = data;

            renderPools(pools.slice(0, 4));
            renderMiniChart(data.chart?.series || []);

            const src = data.meta?.source || "live";
            const updated = data.meta?.updated_at || "";
            statusEl.textContent = `Data: ${src}${updated ? " • Updated " + updated : ""}`;

            const top = [...pools].sort((a,b) => (b.apy ?? 0) - (a.apy ?? 0)).slice(0, 4);
            const baseAvg = top.reduce((s,p) => s + (Number(p.apy)||0), 0) / top.length;

            const trend = [];
            let v = baseAvg;

            for (let i = 0; i < 30; i++) {
                const drift = Math.sin(i / 3) * 0.15;
                const jitter = (Math.random() - 0.5) * 0.25;
                v = Math.max(0.1, v + drift + jitter);
                trend.push(Number(v.toFixed(2)));
            }

            drawAreaLineChart(trendCanvas, trend);

            const best = top[0];
            const tvlSum = top.reduce((s,p) => s + (Number(p.tvl)||0), 0);

            avgApy30.textContent = ((trend.reduce((s,x)=>s+x,0) / trend.length).toFixed(2)) + "%";
            bestPoolName.textContent = best?.name || "—";
            bestPoolApy.textContent = best?.apy != null ? Number(best.apy).toFixed(2) + "%" : "—";
            totalTvl.textContent = "$" + fmtMoney(tvlSum);
            trendMeta.textContent = `Top ${top.length} pools • Updated ${new Date().toLocaleString()}`;

            loadingEl.style.display = 'none';
            trendLoading.style.display = 'none';
        } catch (e) {
            console.error(e);

            if (!lastGood) {
                rowsEl.innerHTML = `<div class="text-sm" style="color:#fca5a5;">Failed to load pools.</div>`;
                trendError.style.display = 'flex';
            }

            loadingEl.style.display = 'none';
            trendLoading.style.display = 'none';
        } finally {
            inFlight = false;
        }
    }

    reloadBtn?.addEventListener("click", loadTopPools);
    window.addEventListener("resize", () => {
        if (lastGood) loadTopPools();
    });

    loadTopPools();
    setInterval(loadTopPools, 60000);
})();
</script>
@endsection
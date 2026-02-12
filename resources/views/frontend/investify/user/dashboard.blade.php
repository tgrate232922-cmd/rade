@extends('frontend::layouts.user')
@section('title')
{{ __('Dashboard') }}
@endsection
@section('content')
<div class="container-fluid default-page">
    
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-dashboard-level-area">
                    <div class="dashboard-card">
                        
                    </div>
                </div>
            </div>
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-dashboard-level-area">
                    
                </div>
            </div>
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-account-card-main">
                    <div class="rock-account-card">
                        <div class="content-inner">
                             <div class="content">
                            <span class="lavel">My Assets</span>
                            
                        </div>
                        <br>
                            <div class="card-content">
                                <div class="info">
                                    
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M22 6H6C3.79086 6 2 7.79086 2 10V18C2 20.2091 3.79086 22 6 22H18C20.2091 22 22 20.2091 22 18V6Z"
                                                fill="white" />
                                            <path d="M22 6C22 3.79086 20.2091 2 18 2H12C9.79086 2 8 3.79086 8 6H22Z"
                                                fill="white" />
                                            <path
                                                d="M2 12L2 16L6 16C7.10457 16 8 15.1046 8 14C8 12.8954 7.10457 12 6 12L2 12Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <h5 class="info-text">{{ __('Funding') }}</h5>
                                </div>
                               
                                <h5 class="title">{{ $currencySymbol.$user->balance }}</h5>
                                
                            </div>
                            <div class="card-content">
                                 <div class="info">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M5.68453 10.2103C6.4673 7.7055 8.7871 6 11.4114 6H12.5891C15.2134 6 17.5332 7.7055 18.316 10.2104L19.566 14.2104C20.7734 18.0739 17.887 22 13.8391 22H10.1614C6.11357 22 3.22716 18.0739 4.43453 14.2104L5.68453 10.2103Z"
                                                fill="white" />
                                            <path
                                                d="M12 20C12 18.8954 12.8954 18 14 18H20C21.1046 18 22 18.8954 22 20C22 21.1046 21.1046 22 20 22H14C12.8954 22 12 21.1046 12 20Z"
                                                fill="white" />
                                            <path
                                                d="M12 16C12 14.8954 12.8954 14 14 14H19.3333H20C21.1046 14 22 14.8954 22 16C22 17.1046 21.1046 18 20 18H14C12.8954 18 12 17.1046 12 16Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <h5 class="info-text">{{ __('Spot') }}</h5>
                                </div>
                           
                                <h5 class="title">{{ $currencySymbol.$user->profit_balance }}</h5>
                               
                            </div>
                        </div>
                        <div class="card-shape">
                            <img src="{{ asset('frontend/theme_base/hardrock/images/rock-shapes/card-shape.png') }}" alt="">
                        </div>
                    </div>
           
                    <div class="account-bg-shape">
                        <img src="{{ asset('frontend/theme_base/hardrock/images/bg/ac-balance-bg.png') }}" alt="">
                    </div>
                </div>
                
                
                
               <!-- Crypto Staking Plan Chart Section -->
               <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Container with proper sizing and spacing -->
<div class="card text-white shadow mb-4" style="background-color: #6337e617;">
  <div class="card-header border-bottom">
    <h5 class="mb-0">Top 10 Staking Protocols (Live TVL)</h5>
  </div>
  <div class="card-body">
    <div style="position:relative; height:400px; width:100%;">
      <canvas id="stakingBarChart" style="background-color: #6337e617; border-radius: 10px;"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  async function loadStakingBarChart() {
    const canvas = document.getElementById('stakingBarChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    try {
      const res = await fetch('https://api.llama.fi/protocols');
      const data = await res.json();

      const stakingData = data
        .filter(p => p.category && p.category.toLowerCase().includes("staking"))
        .sort((a, b) => b.tvl - a.tvl)
        .slice(0, 10);

      const labels = stakingData.map(p => p.name);
      const tvls = stakingData.map(p => p.tvl);

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'TVL (USD)',
            data: tvls,
            backgroundColor: 'rgba(0, 123, 255, 0.7)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1,
            borderRadius: 4
          }]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          plugins: {
            legend: {
              labels: {
                color: '#ffffff'
              }
            },
            tooltip: {
              callbacks: {
                label: context => `$${context.parsed.y.toLocaleString()}`
              }
            }
          },
          scales: {
            x: {
              ticks: { color: '#ccc' },
              grid: { color: 'rgba(255,255,255,0.1)' }
            },
            y: {
              beginAtZero: true,
              ticks: {
                color: '#ccc',
                callback: value => '$' + value.toLocaleString()
              },
              grid: { color: 'rgba(255,255,255,0.1)' }
            }
          }
        }
      });
    } catch (error) {
      console.error("Error loading staking bar chart:", error);
      ctx.font = "16px Arial";
      ctx.fillStyle = "#f00";
      ctx.fillText("Chart loading failed.", 10, 50);
    }
  }

  document.addEventListener("DOMContentLoaded", loadStakingBarChart);
</script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://s3.tradingview.com/tv.js"></script>

<style>
.stake-calculator {
  font-family: Arial, sans-serif;
  background-color: #6337e617;
  color: #fff;
  padding: 1rem;
  margin: 2rem auto;
  max-width: 1200px;
  border-radius: 10px;
}

.stake-calculator h5 {
  text-align: center;
  margin-bottom: 1rem;
}

.stake-calculator .input-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 1rem;
}

.stake-calculator label {
  font-weight: bold;
}

.stake-calculator input[type="number"] {
  padding: 0.6rem;
  border-radius: 5px;
  border: none;
  font-size: 1rem;
  width: 100%;
}

.stake-calculator button,
.stake-calculator a {
  background-color: #075dba;
  color: #fff;
  border: none;
  padding: 0.8rem;
  border-radius: 5px;
  font-size: 1rem;
  cursor: pointer;
  font-weight: bold;
  text-decoration: none;
  display: inline-block;
}

.stake-calculator button:hover {
  background-color: #064fa0;
}

.stake-calculator #results,
.stake-calculator #chartSection {
  display: none;
  margin-top: 2rem;
}

.stake-calculator canvas {
  background-color: #6337e617;
  border-radius: 8px;
  width: 100% !important;
  height: auto !important;
}

.stake-calculator .tradingview-widget-container {
  margin-top: 2rem;
  width: 100%;
}
</style>

<div class="stake-calculator">
  <h5>Yield Projection</h5>
  <div class="input-section">
    <label for="amount">Staking Amount ($):</label>
    <input type="number" id="amount" placeholder="e.g., 10000" min="50" />
    <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
      <button onclick="simulate()">Calculate</button>
      <a href="https://MinxChaink.com/account/user/schemas">Stake Now</a>
    </div>
  </div>

  <div id="results"></div>

  <div id="chartSection">
    <canvas id="earningsChart"></canvas>
    <div class="tradingview-widget-container">
      
    </div>
  </div>

  <button onclick="closeChart()" style="margin-top: 1rem; background-color: #444; color: #fff;">Close Chart</button>
</div>

<script>
const plans = [
  { name: "MinxChain DAO Smart Contract", rate: 1.2, min: 50, max: 999 },
  { name: "MinxChain Boost", rate: 3.2, min: 1000, max: 4999 },
  { name: "MinxChain DAO-farming", rate: 5.2, min: 5000, max: 9999 },
  { name: "MinxChain -IDOs", rate: 7.2, min: 10000, max: 49999 },
  { name: "Meme-pool DAO", rate: 9.5, min: 50000, max: 499999 },
  { name: "DCA Staking", rate: 10.5, min: 500000, max: 1000000 }
];

let chart;

function simulate() {
  const amount = parseFloat(document.getElementById("amount").value);
  const resultDiv = document.getElementById("results");
  const chartSection = document.getElementById("chartSection");

  if (isNaN(amount) || amount < 50) {
    alert("Please enter a valid amount (minimum $50)");
    return;
  }

  const plan = plans.find(p => amount >= p.min && amount <= p.max);
  if (!plan) {
    alert("No matching plan found for the entered amount.");
    return;
  }

  const dailyRate = plan.rate / 100;
  const earnings = [];
  let capital = amount;

  for (let i = 1; i <= 5; i++) {
    capital += capital * dailyRate;
    earnings.push(capital.toFixed(2));
  }

  resultDiv.innerHTML = `
    <h4>Stake: ${plan.name}</h4>
    <p>Daily Rate: ${plan.rate}%</p>
    <p>Total Returns  3-5 Days: $${capital.toFixed(2)}</p>
  `;
  resultDiv.style.display = "block";
  chartSection.style.display = "block";

  const ctx = document.getElementById("earningsChart").getContext("2d");
  if (chart) chart.destroy();

  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5"],
      datasets: [{
        label: 'Capital Growth',
        data: earnings,
        fill: true,
        borderColor: '#075dba',
        backgroundColor: 'rgba(0, 255, 204, 0.1)',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          labels: { color: '#fff' }
        }
      },
      scales: {
        x: {
          ticks: { color: '#fff' }
        },
        y: {
          ticks: { color: '#fff' }
        }
      }
    }
  });

  // Load TradingView widget
  document.getElementById("tradingview_chart").innerHTML = "";
  new TradingView.widget({
    width: "100%",
    height: 500,
    symbol: "AAPL",
    interval: "D",
    timezone: "Etc/UTC",
    theme: "dark",
    style: "1",
    locale: "en",
    toolbar_bg: "#f1f3f6",
    enable_publishing: false,
    hide_side_toolbar: false,
    allow_symbol_change: true,
    container_id: "tradingview_chart"
  });
}

function closeChart() {
  document.getElementById("results").style.display = "none";
  document.getElementById("chartSection").style.display = "none";
  document.getElementById("amount").value = "";
}
</script>










</div>


                
                
                
                
                
                
                
                 
            <br>
                
                
            </div>
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-dashboard-grid">
                    <div class="rock-account-card-wrapper">
                        <h3 class="title">{{ __('My Assets') }}</h3>
                        <div class="rock-account-card-main">
                            <div class="rock-account-card">
                                <div class="content-inner">
                                    <div class="card-content"> 
                                    
                                    <div class="info">
                                            <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M22 6H6C3.79086 6 2 7.79086 2 10V18C2 20.2091 3.79086 22 6 22H18C20.2091 22 22 20.2091 22 18V6Z"
                                                        fill="white" />
                                                    <path
                                                        d="M22 6C22 3.79086 20.2091 2 18 2H12C9.79086 2 8 3.79086 8 6H22Z"
                                                        fill="white" />
                                                    <path
                                                        d="M2 12L2 16L6 16C7.10457 16 8 15.1046 8 14C8 12.8954 7.10457 12 6 12L2 12Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                            <h4 class="info-text">{{ __('Funding') }}</h4>
                                        </div>
                                        <br>
                                        <h5 class="title">{{ $currencySymbol.$user->balance }}</h5>
                                       
                                    </div>
                                    <div class="card-content">
                                         <div class="info">
                                            <span>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                                        fill="white" />
                                                    <path opacity="0.4"
                                                        d="M5.68453 10.2103C6.4673 7.7055 8.7871 6 11.4114 6H12.5891C15.2134 6 17.5332 7.7055 18.316 10.2104L19.566 14.2104C20.7734 18.0739 17.887 22 13.8391 22H10.1614C6.11357 22 3.22716 18.0739 4.43453 14.2104L5.68453 10.2103Z"
                                                        fill="white" />
                                                    <path
                                                        d="M12 20C12 18.8954 12.8954 18 14 18H20C21.1046 18 22 18.8954 22 20C22 21.1046 21.1046 22 20 22H14C12.8954 22 12 21.1046 12 20Z"
                                                        fill="white" />
                                                    <path
                                                        d="M12 16C12 14.8954 12.8954 14 14 14H19.3333H20C21.1046 14 22 14.8954 22 16C22 17.1046 21.1046 18 20 18H14C12.8954 18 12 17.1046 12 16Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                            <h5 class="info-text">{{ __('Spot') }}</h5>
                                        </div>
                                        <br>
                                        <h5 class="title">{{ $currencySymbol.$user->profit_balance }}</h5>
                                       
                                    </div>
                                </div>
                                <div class="card-shape">
                                    <img src="{{ asset('frontend/theme_base/hardrock/images/rock-shapes/card-shape.png') }}" alt="">
                                </div>
                            </div>
                            <div class="rock-account-btn">
                                <a class="site-btn gradient-btn" href="{{ route('user.deposit.amount') }}">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                fill="white" />
                                            <circle cx="18" cy="8" r="4" fill="white" />
                                        </svg>
                                    </span>
                                    {{ __('Deposit') }}
                                </a>
                                <a class="site-btn outline-opcity-btn" href="{{ route('user.schema') }}"> <span><svg width="24"
                                            height="25" viewBox="0 0 24 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M19 13.5C19 17.9183 15.4183 21.5 11 21.5C6.58172 21.5 3 17.9183 3 13.5C3 9.08172 6.58172 5.5 11 5.5C15.4183 5.5 19 9.08172 19 13.5Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16 4.25C15.5858 4.25 15.25 3.91421 15.25 3.5C15.25 3.08579 15.5858 2.75 16 2.75H21C21.4142 2.75 21.75 3.08579 21.75 3.5V8.5C21.75 8.91421 21.4142 9.25 21 9.25C20.5858 9.25 20.25 8.91421 20.25 8.5V5.31066L10.5303 15.0303C10.2374 15.3232 9.76256 15.3232 9.46967 15.0303C9.17678 14.7374 9.17678 14.2626 9.46967 13.9697L19.1893 4.25H16Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    {{ __('Stake') }}
                                </a>
                            </div>
                            <div class="account-bg-shape">
                                <img src="{{ asset('frontend/theme_base/hardrock/images/bg/ac-balance-bg.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="rock-single-card-grid">
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M2 4C2 2.89543 2.89543 2 4 2H12C13.1046 2 14 2.89543 14 4V8C14 9.10457 13.1046 10 12 10H4C2.89543 10 2 9.10457 2 8V4Z"
                                            fill="black" />
                                        <path opacity="0.4"
                                            d="M10 16C10 14.8954 10.8954 14 12 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H12C10.8954 22 10 21.1046 10 20V16Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.6036 6.75L19.8839 7.46967C19.591 7.76256 19.591 8.23744 19.8839 8.53033C20.1768 8.82322 20.6517 8.82322 20.9445 8.53033L22.2374 7.23744C22.9209 6.55402 22.9209 5.44598 22.2374 4.76256L20.9445 3.46967C20.6517 3.17678 20.1768 3.17678 19.8839 3.46967C19.591 3.76256 19.591 4.23744 19.8839 4.53033L20.6036 5.25L16 5.25C15.5858 5.25 15.25 5.58579 15.25 6C15.25 6.41421 15.5858 6.75 16 6.75L20.6036 6.75Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.39645 18.75L4.11612 19.4697C4.40901 19.7626 4.40901 20.2374 4.11612 20.5303C3.82322 20.8232 3.34835 20.8232 3.05546 20.5303L1.76256 19.2374C1.07915 18.554 1.07914 17.446 1.76256 16.7626L3.05546 15.4697C3.34835 15.1768 3.82322 15.1768 4.11612 15.4697C4.40901 15.7626 4.40901 16.2374 4.11612 16.5303L3.39645 17.25L8 17.25C8.41421 17.25 8.75 17.5858 8.75 18C8.75 18.4142 8.41421 18.75 8 18.75L3.39645 18.75Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $dataCount['total_transaction'] }}</h3>
                                <p class="description">{{ __('All Transactions') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                            fill="black" />
                                        <circle cx="18" cy="8" r="4" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_deposit'] }}</h3>
                                <p class="description">{{ __('Deposits') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 5.75C12.4142 5.75 12.75 6.08579 12.75 6.5V7.35352C13.9043 7.67998 14.75 8.74122 14.75 10C14.75 10.4142 14.4142 10.75 14 10.75C13.5858 10.75 13.25 10.4142 13.25 10C13.25 9.30964 12.6904 8.75 12 8.75C11.3096 8.75 10.75 9.30964 10.75 10C10.75 10.6904 11.3096 11.25 12 11.25C13.5188 11.25 14.75 12.4812 14.75 14C14.75 15.2588 13.9043 16.32 12.75 16.6465V17.5C12.75 17.9142 12.4142 18.25 12 18.25C11.5858 18.25 11.25 17.9142 11.25 17.5V16.6465C10.0957 16.32 9.25 15.2588 9.25 14C9.25 13.5858 9.58579 13.25 10 13.25C10.4142 13.25 10.75 13.5858 10.75 14C10.75 14.6904 11.3096 15.25 12 15.25C12.6904 15.25 13.25 14.6904 13.25 14C13.25 13.3096 12.6904 12.75 12 12.75C10.4812 12.75 9.25 11.5188 9.25 10C9.25 8.74122 10.0957 7.67998 11.25 7.35352V6.5C11.25 6.08579 11.5858 5.75 12 5.75Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_investment'] }}
                                </h3>
                                <p class="description">{{ __('Stakes') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                            fill="black" />
                                        <path opacity="0.4"
                                            d="M5.68355 10.2103C6.46632 7.7055 8.78612 6 11.4104 6H12.5881C15.2125 6 17.5323 7.7055 18.315 10.2104L19.565 14.2104C20.7724 18.0739 17.886 22 13.8381 22H10.1604C6.11259 22 3.22618 18.0739 4.43355 14.2104L5.68355 10.2103Z"
                                            fill="black" />
                                        <path
                                            d="M12 20C12 18.8954 12.8954 18 14 18H20C21.1046 18 22 18.8954 22 20C22 21.1046 21.1046 22 20 22H14C12.8954 22 12 21.1046 12 20Z"
                                            fill="black" />
                                        <path
                                            d="M12 16C12 14.8954 12.8954 14 14 14H19.3333H20C21.1046 14 22 14.8954 22 16C22 17.1046 21.1046 18 20 18H14C12.8954 18 12 17.1046 12 16Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_profit'] }}</h3>
                                <p class="description">{{ __('Stake Returns') }}</p>
                            </div>
                        </div>
                        
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M4 12C4 10.8954 4.89543 10 6 10H15C16.1046 10 17 10.8954 17 12C17 13.1046 16.1046 14 15 14H6C4.89543 14 4 13.1046 4 12Z"
                                            fill="black" />
                                        <path
                                            d="M15 14H6.16667C4.97005 14 4 14.8954 4 16C4 17.1046 4.97005 18 6.16667 18H15C16.1046 18 17 17.1046 17 16C17 14.8954 16.1046 14 15 14Z"
                                            fill="black" />
                                        <path opacity="0.4"
                                            d="M20 18C20 15.7909 18.2091 14 16 14C15.8007 14 15.6047 14.0146 15.4132 14.0427C13.4823 14.3266 12 15.9902 12 18C12 20.2091 13.7909 22 16 22C18.2091 22 20 20.2091 20 18Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.25 3.39645L10.5303 4.11612C10.2374 4.40901 9.76256 4.40901 9.46967 4.11612C9.17678 3.82322 9.17678 3.34835 9.46967 3.05546L10.7626 1.76256C11.446 1.07915 12.554 1.07914 13.2374 1.76256L14.5303 3.05546C14.8232 3.34835 14.8232 3.82322 14.5303 4.11612C14.2374 4.40901 13.7626 4.40901 13.4697 4.11612L12.75 3.39645L12.75 7C12.75 7.41421 12.4142 7.75 12 7.75C11.5858 7.75 11.25 7.41421 11.25 7L11.25 3.39645Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_withdraw'] }}</h3>
                                <p class="description">{{ __('Withdrawals') }}</p>
                            </div>
                        </div>
                       
                        
                        
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.8694 13.75C9.79795 13.753 8.7328 14.0456 7.30683 14.6844C6.92882 14.8538 6.4851 14.6847 6.31574 14.3066C6.14638 13.9286 6.31553 13.4849 6.69354 13.3156C8.21341 12.6346 9.49813 12.2538 10.8652 12.25C12.2263 12.2463 13.5951 12.6166 15.2836 13.3056C15.6671 13.4621 15.8511 13.8999 15.6946 14.2834C15.5381 14.6669 15.1003 14.8509 14.7168 14.6944C13.105 14.0366 11.9468 13.747 10.8694 13.75Z"
                                            fill="black" />
                                        <circle cx="3" cy="3" r="3" transform="matrix(1 0 0 -1 8 11)" fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.75 16C18.75 15.5858 18.4142 15.25 18 15.25C17.5858 15.25 17.25 15.5858 17.25 16V17.25H16C15.5858 17.25 15.25 17.5858 15.25 18C15.25 18.4142 15.5858 18.75 16 18.75H17.25V20C17.25 20.4142 17.5858 20.75 18 20.75C18.4142 20.75 18.75 20.4142 18.75 20V18.75H20C20.4142 18.75 20.75 18.4142 20.75 18C20.75 17.5858 20.4142 17.25 20 17.25H18.75V16Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $dataCount['total_referral'] }}</h3>
                                <p class="description">{{ __('Referrals') }}</p>
                            </div>
                        </div>
                        
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.7188 16.5889L13.6905 21.2421C14.1205 21.9154 15.0042 22.1311 15.696 21.7316C16.4363 21.3042 16.6675 20.3438 16.2029 19.6263L13.7755 15.8779L10.7188 16.5889Z"
                                            fill="black" />
                                        <path opacity="0.4"
                                            d="M12.5134 3.98368C13.4294 2.99791 15.0378 3.17971 15.7106 4.34505L20.0027 11.7792C20.6755 12.9445 20.0287 14.4283 18.7171 14.7287L7.79977 17.268L4.79977 12.0718L12.5134 3.98368Z"
                                            fill="black" />
                                        <path
                                            d="M7.84766 16.7273L5.34766 12.3972C4.93344 11.6797 4.01606 11.4339 3.29862 11.8481C2.58118 12.2624 2.33537 13.1797 2.74958 13.8972L5.24958 18.2273C5.66379 18.9447 6.58118 19.1906 7.29862 18.7763C8.01606 18.3621 8.26187 17.4447 7.84766 16.7273Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.0143 2.73953C20.4144 2.84673 20.6519 3.25799 20.5447 3.65809L20.1787 5.02411C20.0714 5.42421 19.6602 5.66165 19.2601 5.55444C18.86 5.44724 18.6226 5.03598 18.7298 4.63588L19.0958 3.26986C19.203 2.86976 19.6142 2.63232 20.0143 2.73953Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.7298 8.09994C20.837 7.69984 21.2482 7.4624 21.6483 7.56961L23.0143 7.93563C23.4144 8.04284 23.6519 8.45409 23.5447 8.85419C23.4375 9.25429 23.0262 9.49173 22.6261 9.38452L21.2601 9.01849C20.86 8.91129 20.6226 8.50004 20.7298 8.09994Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $dataCount['total_ticket'] }}</h3>
                                <p class="description">{{ __('Total Ticket') }}</p>
                            </div>
                        </div>
                        
                       

                    </div>
                    
                </div>
                <br>
                
              
        </div>
        
        
        
        
        
        
        
        
        <div class="col-xl-12">
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <!-- rock all navigation start -->
                <div class="rock-all-navigation-mobile">
                    <h6 class="rock-mobile-title">{{ __('') }}</h6>
                    <div class="all-navigation-inner">
                        <div class="all-navigation-grid">
                            <div class="single-navigation-item">
                                <a href="{{ route('user.schema') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M11.1718 21.6242L3.00221 17.9107C2.22062 17.5554 2.22062 16.4453 3.00221 16.09L11.1718 12.3765C11.6976 12.1375 12.3012 12.1375 12.827 12.3765L20.9966 16.09C21.7782 16.4453 21.7782 17.5554 20.9966 17.9107L12.827 21.6242C12.3012 21.8632 11.6976 21.8632 11.1718 21.6242Z"
                                                fill="white" />
                                            <path
                                                d="M11.1718 16.6242L3.00221 12.9107C2.22062 12.5554 2.22062 11.4453 3.00221 11.09L11.1718 7.37653C11.6976 7.13751 12.3012 7.13751 12.827 7.37653L20.9966 11.09C21.7782 11.4453 21.7782 12.5554 20.9966 12.9107L12.827 16.6242C12.3012 16.8632 11.6976 16.8632 11.1718 16.6242Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M11.1718 11.6242L3.00221 7.91071C2.22062 7.55544 2.22062 6.44525 3.00221 6.08998L11.1718 2.37653C11.6976 2.13751 12.3012 2.13751 12.827 2.37653L20.9966 6.08998C21.7782 6.44525 21.7782 7.55544 20.9966 7.91072L12.827 11.6242C12.3012 11.8632 11.6976 11.8632 11.1718 11.6242Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Yields') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.invest-logs') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                fill="white" />
                                            <circle cx="18" cy="8" r="4" fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Active Stakes') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.transactions') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M2 4C2 2.89543 2.89543 2 4 2H12C13.1046 2 14 2.89543 14 4V8C14 9.10457 13.1046 10 12 10H4C2.89543 10 2 9.10457 2 8V4Z"
                                                fill="white" />
                                            <path opacity="0.4"
                                                d="M10 16C10 14.8954 10.8954 14 12 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H12C10.8954 22 10 21.1046 10 20V16Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.6036 6.75L19.8839 7.46967C19.591 7.76256 19.591 8.23744 19.8839 8.53033C20.1768 8.82322 20.6517 8.82322 20.9445 8.53033L22.2374 7.23744C22.9209 6.55402 22.9209 5.44598 22.2374 4.76256L20.9445 3.46967C20.6517 3.17678 20.1768 3.17678 19.8839 3.46967C19.591 3.76256 19.591 4.23744 19.8839 4.53033L20.6036 5.25L16 5.25C15.5858 5.25 15.25 5.58579 15.25 6C15.25 6.41421 15.5858 6.75 16 6.75L20.6036 6.75Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.39645 18.75L4.11612 19.4697C4.40901 19.7626 4.40901 20.2374 4.11612 20.5303C3.82322 20.8232 3.34835 20.8232 3.05546 20.5303L1.76256 19.2374C1.07915 18.554 1.07914 17.446 1.76256 16.7626L3.05546 15.4697C3.34835 15.1768 3.82322 15.1768 4.11612 15.4697C4.40901 15.7626 4.40901 16.2374 4.11612 16.5303L3.39645 17.25L8 17.25C8.41421 17.25 8.75 17.5858 8.75 18C8.75 18.4142 8.41421 18.75 8 18.75L3.39645 18.75Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Transactions') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.deposit.amount') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 5.75C12.4142 5.75 12.75 6.08579 12.75 6.5V7.35352C13.9043 7.67998 14.75 8.74122 14.75 10C14.75 10.4142 14.4142 10.75 14 10.75C13.5858 10.75 13.25 10.4142 13.25 10C13.25 9.30964 12.6904 8.75 12 8.75C11.3096 8.75 10.75 9.30964 10.75 10C10.75 10.6904 11.3096 11.25 12 11.25C13.5188 11.25 14.75 12.4812 14.75 14C14.75 15.2588 13.9043 16.32 12.75 16.6465V17.5C12.75 17.9142 12.4142 18.25 12 18.25C11.5858 18.25 11.25 17.9142 11.25 17.5V16.6465C10.0957 16.32 9.25 15.2588 9.25 14C9.25 13.5858 9.58579 13.25 10 13.25C10.4142 13.25 10.75 13.5858 10.75 14C10.75 14.6904 11.3096 15.25 12 15.25C12.6904 15.25 13.25 14.6904 13.25 14C13.25 13.3096 12.6904 12.75 12 12.75C10.4812 12.75 9.25 11.5188 9.25 10C9.25 8.74122 10.0957 7.67998 11.25 7.35352V6.5C11.25 6.08579 11.5858 5.75 12 5.75Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Deposit') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.deposit.log') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M20 13C20 17.9706 15.9706 22 11 22C6.02944 22 2 17.9706 2 13C2 8.02944 6.02944 4 11 4C15.9706 4 20 8.02944 20 13Z"
                                                fill="white" />
                                            <path
                                                d="M21.8025 10.0128C21.0104 6.08419 17.9158 2.98956 13.9872 2.19745C12.9045 1.97914 12 2.89543 12 4V10C12 11.1046 12.8954 12 14 12H20C21.1046 12 22.0209 11.0955 21.8025 10.0128Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Deposit log') }}</span>
                                </a>
                            </div>
                            <div class="single-navigation-item">
                                <a href="{{ route('user.wallet-exchange') }}">
                                    <span class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 5.75C12.4142 5.75 12.75 6.08579 12.75 6.5V7.35352C13.9043 7.67998 14.75 8.74122 14.75 10C14.75 10.4142 14.4142 10.75 14 10.75C13.5858 10.75 13.25 10.4142 13.25 10C13.25 9.30964 12.6904 8.75 12 8.75C11.3096 8.75 10.75 9.30964 10.75 10C10.75 10.6904 11.3096 11.25 12 11.25C13.5188 11.25 14.75 12.4812 14.75 14C14.75 15.2588 13.9043 16.32 12.75 16.6465V17.5C12.75 17.9142 12.4142 18.25 12 18.25C11.5858 18.25 11.25 17.9142 11.25 17.5V16.6465C10.0957 16.32 9.25 15.2588 9.25 14C9.25 13.5858 9.58579 13.25 10 13.25C10.4142 13.25 10.75 13.5858 10.75 14C10.75 14.6904 11.3096 15.25 12 15.25C12.6904 15.25 13.25 14.6904 13.25 14C13.25 13.3096 12.6904 12.75 12 12.75C10.4812 12.75 9.25 11.5188 9.25 10C9.25 8.74122 10.0957 7.67998 11.25 7.35352V6.5C11.25 6.08579 11.5858 5.75 12 5.75Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.88648 8.71859C5.18395 5.51328 8.32685 3.25 12.0002 3.25C16.351 3.25 19.9602 6.42553 20.6364 10.5853L21.5502 9.9C21.8815 9.65147 22.3516 9.71863 22.6002 10.05C22.8487 10.3814 22.7815 10.8515 22.4502 11.1L21.439 11.8584C20.6057 12.4833 19.4908 12.5839 18.5592 12.118L17.6648 11.6708C17.2943 11.4856 17.1441 11.0351 17.3293 10.6646C17.5146 10.2941 17.9651 10.1439 18.3356 10.3292L19.1395 10.7311C18.5395 7.33207 15.5714 4.75 12.0002 4.75C8.95872 4.75 6.35296 6.62306 5.27689 9.28141C5.12147 9.66536 4.68422 9.85062 4.30027 9.6952C3.91632 9.53978 3.73106 9.10254 3.88648 8.71859ZM3.32897 13.1794C3.29555 13.1926 3.26253 13.2073 3.23 13.2236L2.33557 13.6708C1.96509 13.8561 1.51459 13.7059 1.32934 13.3354C1.1441 12.9649 1.29427 12.5144 1.66475 12.3292L2.55918 11.882C3.49084 11.4161 4.60572 11.5167 5.43902 12.1416L6.45016 12.9C6.78154 13.1485 6.84869 13.6186 6.60016 13.95C6.35164 14.2814 5.88154 14.3485 5.55016 14.1L4.93635 13.6396C5.67946 16.8539 8.56 19.25 12.0002 19.25C15.0416 19.25 17.6474 17.3769 18.7234 14.7186C18.8789 14.3346 19.3161 14.1494 19.7001 14.3048C20.084 14.4602 20.2693 14.8975 20.1139 15.2814C18.8164 18.4867 15.6735 20.75 12.0002 20.75C7.56763 20.75 3.90489 17.4541 3.32897 13.1794Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span class="title">{{ __('Swap') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="moretext">
                            <div class="all-navigation-grid">
                               
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.withdraw.view') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M4 12C4 10.8954 4.89543 10 6 10H15C16.1046 10 17 10.8954 17 12C17 13.1046 16.1046 14 15 14H6C4.89543 14 4 13.1046 4 12Z"
                                                    fill="white" />
                                                <path
                                                    d="M15 14H6.16667C4.97005 14 4 14.8954 4 16C4 17.1046 4.97005 18 6.16667 18H15C16.1046 18 17 17.1046 17 16C17 14.8954 16.1046 14 15 14Z"
                                                    fill="white" />
                                                <path opacity="0.4"
                                                    d="M20 18C20 15.7909 18.2091 14 16 14C15.8007 14 15.6047 14.0146 15.4132 14.0427C13.4823 14.3266 12 15.9902 12 18C12 20.2091 13.7909 22 16 22C18.2091 22 20 20.2091 20 18Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.25 3.39645L10.5303 4.11612C10.2374 4.40901 9.76256 4.40901 9.46967 4.11612C9.17678 3.82322 9.17678 3.34835 9.46967 3.05546L10.7626 1.76256C11.446 1.07915 12.554 1.07914 13.2374 1.76256L14.5303 3.05546C14.8232 3.34835 14.8232 3.82322 14.5303 4.11612C14.2374 4.40901 13.7626 4.40901 13.4697 4.11612L12.75 3.39645L12.75 7C12.75 7.41421 12.4142 7.75 12 7.75C11.5858 7.75 11.25 7.41421 11.25 7L11.25 3.39645Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Withdraw') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.withdraw.log') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M18 4C19.1046 4 20 4.89543 20 6C20 7.10457 19.1046 8 18 8L10 8C8.89543 8 8 7.10457 8 6C8 4.89543 8.89543 4 10 4L18 4Z"
                                                    fill="white" />
                                                <path opacity="0.4"
                                                    d="M18 12C19.1046 12 20 12.8954 20 14C20 15.1046 19.1046 16 18 16L10 16C8.89543 16 8 15.1046 8 14C8 12.8954 8.89543 12 10 12L18 12Z"
                                                    fill="white" />
                                                <rect x="16" y="8" width="4" height="12" rx="2"
                                                    transform="rotate(90 16 8)" fill="white" />
                                                <rect x="17" y="16" width="4" height="12" rx="2"
                                                    transform="rotate(90 17 16)" fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Withdrawals') }}</span>
                                    </a>
                                </div>
                               
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.referral') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.8694 13.75C9.79795 13.753 8.7328 14.0456 7.30683 14.6844C6.92882 14.8538 6.4851 14.6847 6.31574 14.3066C6.14638 13.9286 6.31553 13.4849 6.69354 13.3156C8.21341 12.6346 9.49813 12.2538 10.8652 12.25C12.2263 12.2463 13.5951 12.6166 15.2836 13.3056C15.6671 13.4621 15.8511 13.8999 15.6946 14.2834C15.5381 14.6669 15.1003 14.8509 14.7168 14.6944C13.105 14.0366 11.9468 13.747 10.8694 13.75Z"
                                                    fill="white" />
                                                <circle cx="3" cy="3" r="3" transform="matrix(1 0 0 -1 8 11)"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.75 16C18.75 15.5858 18.4142 15.25 18 15.25C17.5858 15.25 17.25 15.5858 17.25 16V17.25H16C15.5858 17.25 15.25 17.5858 15.25 18C15.25 18.4142 15.5858 18.75 16 18.75H17.25V20C17.25 20.4142 17.5858 20.75 18 20.75C18.4142 20.75 18.75 20.4142 18.75 20V18.75H20C20.4142 18.75 20.75 18.4142 20.75 18C20.75 17.5858 20.4142 17.25 20 17.25H18.75V16Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Referral') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.setting.show') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                    d="M12.9545 3H11.0455C9.99109 3 9.13635 3.80589 9.13635 4.8C9.13635 5.93761 7.91917 6.66087 6.92 6.11697L6.81852 6.06172C5.90541 5.56467 4.73782 5.85964 4.21064 6.72057L3.25609 8.27942C2.72891 9.14034 3.04176 10.2412 3.95487 10.7383C4.95451 11.2824 4.95451 12.7176 3.95487 13.2617C3.04176 13.7588 2.72891 14.8597 3.25609 15.7206L4.21064 17.2794C4.73782 18.1404 5.90541 18.4353 6.81851 17.9383L6.92 17.883C7.91917 17.3391 9.13635 18.0624 9.13635 19.2C9.13635 20.1941 9.99109 21 11.0455 21H12.9545C14.0089 21 14.8636 20.1941 14.8636 19.2C14.8636 18.0624 16.0808 17.3391 17.08 17.883L17.1815 17.9383C18.0946 18.4353 19.2622 18.1403 19.7894 17.2794L20.7439 15.7206C21.2711 14.8596 20.9582 13.7588 20.0451 13.2617C19.0455 12.7176 19.0455 11.2824 20.0451 10.7383C20.9582 10.2412 21.2711 9.14036 20.7439 8.27943L19.7894 6.72058C19.2622 5.85966 18.0946 5.56468 17.1815 6.06174L17.08 6.11698C16.0808 6.66088 14.8636 5.93762 14.8636 4.8C14.8636 3.80589 14.0089 3 12.9545 3Z"
                                                    fill="white" />
                                                <circle cx="12" cy="12" r="3" fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Settings') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.ticket.index') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.7188 16.5889L13.6905 21.2421C14.1205 21.9154 15.0042 22.1311 15.696 21.7316C16.4363 21.3042 16.6675 20.3438 16.2029 19.6263L13.7755 15.8779L10.7188 16.5889Z"
                                                    fill="white" />
                                                <path opacity="0.4"
                                                    d="M12.5125 3.98416C13.4284 2.9984 15.0369 3.1802 15.7097 4.34554L20.0017 11.7796C20.6746 12.945 20.0278 14.4288 18.7161 14.7292L7.79879 17.2685L4.79879 12.0723L12.5125 3.98416Z"
                                                    fill="white" />
                                                <path
                                                    d="M7.84766 16.7268L5.34766 12.3967C4.93344 11.6793 4.01606 11.4334 3.29862 11.8477C2.58118 12.2619 2.33537 13.1793 2.74958 13.8967L5.24958 18.2268C5.66379 18.9443 6.58118 19.1901 7.29862 18.7759C8.01606 18.3616 8.26187 17.4443 7.84766 16.7268Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M20.0143 2.73953C20.4144 2.84673 20.6519 3.25799 20.5447 3.65809L20.1787 5.02411C20.0714 5.42421 19.6602 5.66165 19.2601 5.55444C18.86 5.44724 18.6226 5.03598 18.7298 4.63588L19.0958 3.26986C19.203 2.86976 19.6142 2.63232 20.0143 2.73953Z"
                                                    fill="white" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M20.7298 8.09994C20.837 7.69984 21.2482 7.4624 21.6483 7.56961L23.0143 7.93563C23.4144 8.04284 23.6519 8.45409 23.5447 8.85419C23.4375 9.25429 23.0262 9.49173 22.6261 9.38452L21.2601 9.01849C20.86 8.91129 20.6226 8.50004 20.7298 8.09994Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Help Center') }}</span>
                                    </a>
                                </div>
                                <div class="single-navigation-item">
                                    <a href="{{ route('user.notification.all') }}">
                                        <span class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 21C13.385 21 14.5633 20.1652 15 19H9C9.43668 20.1652 10.615 21 12 21Z"
                                                    fill="white" />
                                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.6896 3.75403C13.274 3.29116 12.671 3 12 3C10.7463 3 9.73005 4.01629 9.73005 5.26995V5.37366C7.58766 6.10719 6.0016 7.85063 5.76046 9.97519L5.31328 13.9153C5.23274 14.6249 4.93344 15.3016 4.44779 15.8721C3.35076 17.1609 4.39443 19 6.22281 19H17.7772C19.6056 19 20.6492 17.1609 19.5522 15.8721C19.0666 15.3016 18.7673 14.6249 18.6867 13.9153L18.2395 9.97519C18.2333 9.92024 18.2262 9.86556 18.2181 9.81113C17.8341 9.93379 17.4248 10 17 10C14.7909 10 13 8.20914 13 6C13 5.16744 13.2544 4.3943 13.6896 3.75403Z"
                                                    fill="white" />
                                                <circle cx="17" cy="6" r="3" fill="white" />
                                            </svg>
                                        </span>
                                        <span class="title">{{ __('Notifications') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-15">
                        <button class="rock-moreless-button site-btn transparent-btn">{{ __('Load more') }}</button>
                    </div>
                </div>
                <!-- rock all navigation start -->
            </div>
        </div>
        <div class="col-xl-12">
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-mobile-common-table mt-30 mb-30">
                    <h6 class="rock-mobile-title mb-15">{{ __('') }}</h6>
                    <!-- rock all navigation start -->
                    <div class="rock-single-card-grid">
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M2 4C2 2.89543 2.89543 2 4 2H12C13.1046 2 14 2.89543 14 4V8C14 9.10457 13.1046 10 12 10H4C2.89543 10 2 9.10457 2 8V4Z"
                                            fill="black" />
                                        <path opacity="0.4"
                                            d="M10 16C10 14.8954 10.8954 14 12 14H20C21.1046 14 22 14.8954 22 16V20C22 21.1046 21.1046 22 20 22H12C10.8954 22 10 21.1046 10 20V16Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.6036 6.75L19.8839 7.46967C19.591 7.76256 19.591 8.23744 19.8839 8.53033C20.1768 8.82322 20.6517 8.82322 20.9445 8.53033L22.2374 7.23744C22.9209 6.55402 22.9209 5.44598 22.2374 4.76256L20.9445 3.46967C20.6517 3.17678 20.1768 3.17678 19.8839 3.46967C19.591 3.76256 19.591 4.23744 19.8839 4.53033L20.6036 5.25L16 5.25C15.5858 5.25 15.25 5.58579 15.25 6C15.25 6.41421 15.5858 6.75 16 6.75L20.6036 6.75Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.39645 18.75L4.11612 19.4697C4.40901 19.7626 4.40901 20.2374 4.11612 20.5303C3.82322 20.8232 3.34835 20.8232 3.05546 20.5303L1.76256 19.2374C1.07915 18.554 1.07914 17.446 1.76256 16.7626L3.05546 15.4697C3.34835 15.1768 3.82322 15.1768 4.11612 15.4697C4.40901 15.7626 4.40901 16.2374 4.11612 16.5303L3.39645 17.25L8 17.25C8.41421 17.25 8.75 17.5858 8.75 18C8.75 18.4142 8.41421 18.75 8 18.75L3.39645 18.75Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title">{{ $dataCount['total_transaction'] }}</h3>
                                <p class="description">{{ __('Transactions') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                            fill="black" />
                                        <circle cx="18" cy="8" r="4" fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_deposit'] }}</h3>
                                <p class="description">{{ __('Deposits') }}</p>
                            </div>
                        </div>
                        <div class="rock-single-card">
                            <div class="icon">
                                <span>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                            fill="black" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 5.75C12.4142 5.75 12.75 6.08579 12.75 6.5V7.35352C13.9043 7.67998 14.75 8.74122 14.75 10C14.75 10.4142 14.4142 10.75 14 10.75C13.5858 10.75 13.25 10.4142 13.25 10C13.25 9.30964 12.6904 8.75 12 8.75C11.3096 8.75 10.75 9.30964 10.75 10C10.75 10.6904 11.3096 11.25 12 11.25C13.5188 11.25 14.75 12.4812 14.75 14C14.75 15.2588 13.9043 16.32 12.75 16.6465V17.5C12.75 17.9142 12.4142 18.25 12 18.25C11.5858 18.25 11.25 17.9142 11.25 17.5V16.6465C10.0957 16.32 9.25 15.2588 9.25 14C9.25 13.5858 9.58579 13.25 10 13.25C10.4142 13.25 10.75 13.5858 10.75 14C10.75 14.6904 11.3096 15.25 12 15.25C12.6904 15.25 13.25 14.6904 13.25 14C13.25 13.3096 12.6904 12.75 12 12.75C10.4812 12.75 9.25 11.5188 9.25 10C9.25 8.74122 10.0957 7.67998 11.25 7.35352V6.5C11.25 6.08579 11.5858 5.75 12 5.75Z"
                                            fill="black" />
                                    </svg>
                                </span>
                            </div>
                            <div class="content">
                                <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_investment'] }}
                                </h3>
                                <p class="description">{{ __('Stakes') }}</p>
                            </div>
                        </div>
                        <div class="moretext-2 rock-single-card-grid">
                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M14.0859 7L9.91411 7L8.51303 5.39296C7.13959 3.81763 8.74185 1.46298 10.7471 2.10985L11.6748 2.40914C11.8861 2.47728 12.1139 2.47728 12.3252 2.40914L13.2529 2.10985C15.2582 1.46298 16.8604 3.81763 15.487 5.39296L14.0859 7Z"
                                                fill="black" />
                                            <path opacity="0.4"
                                                d="M5.68355 10.2103C6.46632 7.7055 8.78612 6 11.4104 6H12.5881C15.2125 6 17.5323 7.7055 18.315 10.2104L19.565 14.2104C20.7724 18.0739 17.886 22 13.8381 22H10.1604C6.11259 22 3.22618 18.0739 4.43355 14.2104L5.68355 10.2103Z"
                                                fill="black" />
                                            <path
                                                d="M12 20C12 18.8954 12.8954 18 14 18H20C21.1046 18 22 18.8954 22 20C22 21.1046 21.1046 22 20 22H14C12.8954 22 12 21.1046 12 20Z"
                                                fill="black" />
                                            <path
                                                d="M12 16C12 14.8954 12.8954 14 14 14H19.3333H20C21.1046 14 22 14.8954 22 16C22 17.1046 21.1046 18 20 18H14C12.8954 18 12 17.1046 12 16Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_profit'] }}</h3>
                                    <p class="description">{{ __('Stake Returns') }}</p>
                                </div>
                            </div>
                            
                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M4 12C4 10.8954 4.89543 10 6 10H15C16.1046 10 17 10.8954 17 12C17 13.1046 16.1046 14 15 14H6C4.89543 14 4 13.1046 4 12Z"
                                                fill="black" />
                                            <path
                                                d="M15 14H6.16667C4.97005 14 4 14.8954 4 16C4 17.1046 4.97005 18 6.16667 18H15C16.1046 18 17 17.1046 17 16C17 14.8954 16.1046 14 15 14Z"
                                                fill="black" />
                                            <path opacity="0.4"
                                                d="M20 18C20 15.7909 18.2091 14 16 14C15.8007 14 15.6047 14.0146 15.4132 14.0427C13.4823 14.3266 12 15.9902 12 18C12 20.2091 13.7909 22 16 22C18.2091 22 20 20.2091 20 18Z"
                                                fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.25 3.39645L10.5303 4.11612C10.2374 4.40901 9.76256 4.40901 9.46967 4.11612C9.17678 3.82322 9.17678 3.34835 9.46967 3.05546L10.7626 1.76256C11.446 1.07915 12.554 1.07914 13.2374 1.76256L14.5303 3.05546C14.8232 3.34835 14.8232 3.82322 14.5303 4.11612C14.2374 4.40901 13.7626 4.40901 13.4697 4.11612L12.75 3.39645L12.75 7C12.75 7.41421 12.4142 7.75 12 7.75C11.5858 7.75 11.25 7.41421 11.25 7L11.25 3.39645Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title"><span>{{ $currencySymbol }}</span>{{ $dataCount['total_withdraw'] }}</h3>
                                    <p class="description">{{ __('Withdrawals') }}</p>
                                </div>
                            </div>
                            
                            
                           
                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4"
                                                d="M20 11C20 6.02944 15.9706 2 11 2C6.02944 2 2 6.02944 2 11C2 15.9706 6.02944 20 11 20C15.9706 20 20 15.9706 20 11Z"
                                                fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.8694 13.75C9.79795 13.753 8.7328 14.0456 7.30683 14.6844C6.92882 14.8538 6.4851 14.6847 6.31574 14.3066C6.14638 13.9286 6.31553 13.4849 6.69354 13.3156C8.21341 12.6346 9.49813 12.2538 10.8652 12.25C12.2263 12.2463 13.5951 12.6166 15.2836 13.3056C15.6671 13.4621 15.8511 13.8999 15.6946 14.2834C15.5381 14.6669 15.1003 14.8509 14.7168 14.6944C13.105 14.0366 11.9468 13.747 10.8694 13.75Z"
                                                fill="black" />
                                            <circle cx="3" cy="3" r="3" transform="matrix(1 0 0 -1 8 11)" fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M18.75 16C18.75 15.5858 18.4142 15.25 18 15.25C17.5858 15.25 17.25 15.5858 17.25 16V17.25H16C15.5858 17.25 15.25 17.5858 15.25 18C15.25 18.4142 15.5858 18.75 16 18.75H17.25V20C17.25 20.4142 17.5858 20.75 18 20.75C18.4142 20.75 18.75 20.4142 18.75 20V18.75H20C20.4142 18.75 20.75 18.4142 20.75 18C20.75 17.5858 20.4142 17.25 20 17.25H18.75V16Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title">{{ $dataCount['total_referral'] }}</h3>
                                    <p class="description">{{ __('Referrals') }}</p>
                                </div>
                            </div>
                          
                            <div class="rock-single-card">
                                <div class="icon">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.7188 16.5889L13.6905 21.2421C14.1205 21.9154 15.0042 22.1311 15.696 21.7316C16.4363 21.3042 16.6675 20.3438 16.2029 19.6263L13.7755 15.8779L10.7188 16.5889Z"
                                                fill="black" />
                                            <path opacity="0.4"
                                                d="M12.5134 3.98368C13.4294 2.99791 15.0378 3.17971 15.7106 4.34505L20.0027 11.7792C20.6755 12.9445 20.0287 14.4283 18.7171 14.7287L7.79977 17.268L4.79977 12.0718L12.5134 3.98368Z"
                                                fill="black" />
                                            <path
                                                d="M7.84766 16.7273L5.34766 12.3972C4.93344 11.6797 4.01606 11.4339 3.29862 11.8481C2.58118 12.2624 2.33537 13.1797 2.74958 13.8972L5.24958 18.2273C5.66379 18.9447 6.58118 19.1906 7.29862 18.7763C8.01606 18.3621 8.26187 17.4447 7.84766 16.7273Z"
                                                fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.0143 2.73953C20.4144 2.84673 20.6519 3.25799 20.5447 3.65809L20.1787 5.02411C20.0714 5.42421 19.6602 5.66165 19.2601 5.55444C18.86 5.44724 18.6226 5.03598 18.7298 4.63588L19.0958 3.26986C19.203 2.86976 19.6142 2.63232 20.0143 2.73953Z"
                                                fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M20.7298 8.09994C20.837 7.69984 21.2482 7.4624 21.6483 7.56961L23.0143 7.93563C23.4144 8.04284 23.6519 8.45409 23.5447 8.85419C23.4375 9.25429 23.0262 9.49173 22.6261 9.38452L21.2601 9.01849C20.86 8.91129 20.6226 8.50004 20.7298 8.09994Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="content">
                                    <h3 class="title">{{ $dataCount['total_ticket'] }}</h3>
                                    <p class="description">{{ __('Total Ticket') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="rock-moreless-button-2 site-btn transparent-btn">{{ __('Load more') }}</button>
                        </div>
                    </div>
                    
                   
                    <!-- rock all navigation start -->
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        <div class="col-xl-12">
            <!-- Show desktop-screen content -->
            <div class="rock-desktop-screen-show">
                <div class="rock-recent-transactions-area">
                    <div class="rock-dashboard-card">
                        <div class="rock-dashboard-title-inner">
                            <h3 class="rock-dashboard-tile">{{ __('Recent Transactions') }}</h3>
                        </div>
                        <div class="rock-recent-transactions-table">
                            <div class="rock-custom-table">
                                <div class="contents">
                                    <div class="site-table-list site-table-head">
                                        <div class="site-table-col">{{ __('Description') }}</div>
                                        <div class="site-table-col">{{ __('Transaction ID') }}</div>
                                        <div class="site-table-col">{{ __('Type') }}</div>
                                        <div class="site-table-col">{{ __('Amount') }}</div>
                                        <div class="site-table-col">{{ __('Charge') }}</div>
                                        <div class="site-table-col">{{ __('Status') }}</div>
                                        <div class="site-table-col">{{ __('Gateway') }}</div>
                                    </div>
                                    @foreach($recentTransactions as $transaction)
                                    <div class="site-table-list">
                                        <div class="site-table-col">
                                            <div class="transactions-description">
                                                <div class="iocn">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4"
                                                            d="M4 8H2V17L6.31083 19.1554C7.42168 19.7108 8.64658 20 9.88854 20H18C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16H16.4164C15.4849 16 14.5663 15.7831 13.7331 15.3666L10.792 13.896C10.9843 13.7189 11.1432 13.4993 11.2528 13.2434C11.6664 12.2784 11.2241 11.1605 10.2622 10.7397L4 8Z"
                                                            fill="#E9D8A6" />
                                                        <circle cx="18" cy="8" r="4" fill="#E9D8A6" />
                                                    </svg>
                                                </div>
                                                <div class="content">
                                                    <h4 class="title pinkDiamond-text">
                                                        {{ $transaction->description }}
                                                    </h4>
                                                    <p class="description">{{ $transaction->created_at }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="site-table-col">
                                            <span class="white-text">{{ $transaction->tnx }}</span>
                                        </div>
                                        <div class="site-table-col">
                                            <span
                                                class="kittensEye-text">{{ ucwords(str_replace('_',' ',$transaction->type->value)) }}</span>
                                        </div>
                                        @php
                                        $minusSvg ='<svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M3.55545 11.4419C3.79953 11.686 4.19526 11.686 4.43934 11.4419L7.77267 8.10861C8.01675 7.86453 8.01675 7.4688 7.77267 7.22472C7.52859 6.98065 7.13286 6.98065 6.88879 7.22472L4.6224 9.49112V1C4.6224 0.654822 4.34257 0.375 3.9974 0.375C3.65222 0.375 3.3724 0.654822 3.3724 1V9.49112L1.106 7.22472C0.861927 6.98065 0.466198 6.98065 0.222121 7.22472C-0.0219569 7.4688 -0.0219569 7.86453 0.222121 8.10861L3.55545 11.4419Z"
                                                fill="#FF3E3E" />
                                        </svg>';

                                        $plusSvg = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                                fill="#85FFC4" />
                                        </svg>';
                                        @endphp
                                        <div class="site-table-col">
                                            <span
                                                class="{{ txn_type($transaction->type->value,['success-text','danger-text'],'hardrock') }}">
                                                {{ txn_type($transaction->type->value,['+','-'],'hardrock') }}
                                                {{ $transaction->amount }} {{ $currency }}

                                                @if(txn_type($transaction->type->value,['+','-'],'hardrock') == '-')
                                                {!! $minusSvg !!}
                                                @else
                                                {!! $plusSvg !!}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="site-table-col">
                                            <span class="white-text">{{ $transaction->charge }} {{ $currency }}</span>
                                        </div>
                                        <div class="site-table-col">
                                            <span @class([ 'rock-badge' , 'badge-success'=> $transaction->status->value ==
                                                'success',
                                                'danger' => $transaction->status->value == 'failed',
                                                'warning' => $transaction->status->value == 'pending',
                                                ])>
                                                {{ ucfirst($transaction->status->value) }}
                                            </span>
                                        </div>
                                        <div class="site-table-col">
                                            <span class="white-text">{{ $transaction->method }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Show mobile-screen content -->
            <div class="rock-mobile-screen-show">
                <div class="rock-mobile-common-table">
                    <h6 class="rock-mobile-title mb-15">{{ __('Recent Transactions') }}</h6>
                    @foreach($recentTransactions as $transaction)
                    <div class="rock-mobile-table-card">
                        <div class="transactions-description">
                            <div class="iocn">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                        d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10Z"
                                        fill="#FFD6FF" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 3.75C10.4142 3.75 10.75 4.08579 10.75 4.5V5.35352C11.9043 5.67998 12.75 6.74122 12.75 8C12.75 8.41421 12.4142 8.75 12 8.75C11.5858 8.75 11.25 8.41421 11.25 8C11.25 7.30964 10.6904 6.75 10 6.75C9.30964 6.75 8.75 7.30964 8.75 8C8.75 8.69036 9.30964 9.25 10 9.25C11.5188 9.25 12.75 10.4812 12.75 12C12.75 13.2588 11.9043 14.32 10.75 14.6465V15.5C10.75 15.9142 10.4142 16.25 10 16.25C9.58579 16.25 9.25 15.9142 9.25 15.5V14.6465C8.09575 14.32 7.25 13.2588 7.25 12C7.25 11.5858 7.58579 11.25 8 11.25C8.41421 11.25 8.75 11.5858 8.75 12C8.75 12.6904 9.30964 13.25 10 13.25C10.6904 13.25 11.25 12.6904 11.25 12C11.25 11.3096 10.6904 10.75 10 10.75C8.48122 10.75 7.25 9.51878 7.25 8C7.25 6.74122 8.09575 5.67998 9.25 5.35352V4.5C9.25 4.08579 9.58579 3.75 10 3.75Z"
                                        fill="#FFD6FF" />
                                </svg>
                            </div>
                            <div class="content">
                                <h4 class="title pinkDiamond-text">{{ $transaction->description }}</h4>
                                <p class="description">{{ $transaction->created_at }}</p>
                            </div>
                        </div>
                        @php
                        $minusSvg ='<svg width="8" height="12" viewBox="0 0 8 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.55545 11.4419C3.79953 11.686 4.19526 11.686 4.43934 11.4419L7.77267 8.10861C8.01675 7.86453 8.01675 7.4688 7.77267 7.22472C7.52859 6.98065 7.13286 6.98065 6.88879 7.22472L4.6224 9.49112V1C4.6224 0.654822 4.34257 0.375 3.9974 0.375C3.65222 0.375 3.3724 0.654822 3.3724 1V9.49112L1.106 7.22472C0.861927 6.98065 0.466198 6.98065 0.222121 7.22472C-0.0219569 7.4688 -0.0219569 7.86453 0.222121 8.10861L3.55545 11.4419Z"
                                fill="#FF3E3E" />
                        </svg>';

                        $plusSvg = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.55545 4.55806C9.79953 4.31398 10.1953 4.31398 10.4393 4.55806L13.7727 7.89139C14.0167 8.13547 14.0167 8.5312 13.7727 8.77528C13.5286 9.01935 13.1329 9.01935 12.8888 8.77528L10.6224 6.50888V15C10.6224 15.3452 10.3426 15.625 9.9974 15.625C9.65222 15.625 9.3724 15.3452 9.3724 15V6.50888L7.106 8.77528C6.86193 9.01935 6.4662 9.01935 6.22212 8.77528C5.97804 8.5312 5.97804 8.13547 6.22212 7.89139L9.55545 4.55806Z"
                                fill="#85FFC4" />
                        </svg>';
                        @endphp
                        <div class="transactions-short-content">
                            <span
                                class="{{ txn_type($transaction->type->value,['success-text','danger-text'],'hardrock') }}">
                                {{ txn_type($transaction->type->value,['+','-'],'hardrock') }}
                                {{ $transaction->amount }} {{ $currency }}

                                @if(txn_type($transaction->type->value,['+','-'],'hardrock') == '-')
                                {!! $minusSvg !!}
                                @else
                                {!! $plusSvg !!}
                                @endif
                            </span>
                            <span class="white-text d-block">
                                -{{ $transaction->charge }} {{ $currency }}
                            </span>
                            <span class="white-text d-block">
                                {{ $transaction->method }}
                            </span>
                        </div>
                        <div class="transaction-id">
                            <span class="white-text d-block">
                                {{ $transaction->tnx }}
                            </span>
                        </div>
                        <div class="transactions-badge">
                            <span @class([ 'rock-badge' , 'success'=> $transaction->status->value == 'success',
                                'danger' => $transaction->status->value == 'failed',
                                'warning' => $transaction->status->value == 'pending',
                                ])>
                                {{ ucfirst($transaction->status->value) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(setting('sign_up_referral','permission'))
        
        @endif
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const copyButtons = document.querySelectorAll('.referral-url-copy-btn');

      copyButtons.forEach(button => {
        button.addEventListener('click', (event) => {
          const referralLink = button.previousElementSibling.textContent;
          copyToClipboard(referralLink, button.nextElementSibling);
        });
      });
    });

    function copyToClipboard(linkText, copyMessageElement) {
      const textArea = document.createElement('textarea');
      textArea.value = linkText;
      document.body.appendChild(textArea);
      textArea.select();
      document.execCommand('copy');
      document.body.removeChild(textArea);

      copyMessageElement.style.opacity = 1;
      setTimeout(() => {
        copyMessageElement.style.opacity = 0;
      }, 2000);
    }

    // Load More
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
</script>


<script>
  function calculate() {
    var investment = parseFloat(document.getElementById('investment').value);
    var dailyReturn = 0;
    var totalReturn = 0;
    var totalProfit = 0;
    var planName = "";

    if (investment >= 1000 && investment <= 4999) {
      dailyReturn = investment * 0.02; // 2% daily return
      planName = "Bitsvance Boost";
   
    } else if (investment >= 5000 && investment <= 9999) {
      dailyReturn = investment * 0.03; // 3% daily return
      planName = "Bitsvance DAO-farming";
    } else if (investment >= 10000 && investment <= 49999) {
      dailyReturn = investment * 0.035; // 3.5% daily return
      planName = "Bitsvance- IDOs";
    } else if (investment >= 50000 && investment <= 499999) {
      dailyReturn = investment * 0.04; // 4% daily return
      planName = "Meme-pool DAO"; 
        } else if (investment >= 500000 && investment <= 1000000) {
      dailyReturn = investment * 0.045; // 4.5% daily return
      planName = " 	DCA Staking";
    }
    
    totalReturn = dailyReturn * 3; // Total return over 3 days
    totalProfit = totalReturn + investment; // Total including return of capital
    
    var resultElement = document.getElementById('result');
    resultElement.innerHTML = `
      <p>Staking Plan: ${planName}</p>
      <p>Daily return: $${dailyReturn.toFixed(2)}</p>
      <p>Total return after 3 days: $${totalReturn.toFixed(2)}</p>
      <p>Total including return of capital: $${totalProfit.toFixed(2)}</p>
    `;
  }
</script>
@endsection

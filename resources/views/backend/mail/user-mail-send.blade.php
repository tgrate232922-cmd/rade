<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $details['title'] }}</title>
    <style>body{
  margin:0;
  padding:0;
  background:#06111f;
  font-family:'Jost', Arial, sans-serif;
}

table{
  border-spacing:0;
  border-collapse:collapse;
}

img{
  border:0;
  display:block;
  max-width:100%;
}

a{
  text-decoration:none;
}

.wrapper{
  width:100%;
  background:
    radial-gradient(circle at top right, rgba(103,232,249,.10), transparent 28%),
    radial-gradient(circle at bottom left, rgba(37,99,235,.10), transparent 35%),
    linear-gradient(135deg,#06111f 0%,#0a2030 50%,#06121f 100%);
  padding:24px 12px;
}

.container{
  width:100%;
  max-width:650px;
  margin:0 auto;
}

.header{
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  padding:28px 24px;
  border-radius:22px 22px 0 0;
  text-align:center;
  border:1px solid rgba(125,211,252,.20);
  border-bottom:none;
}

.logo img{
  height:40px;
  width:auto;
  margin:0 auto;
}

.hero{
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  padding:0 24px 28px;
  text-align:center;
  border-left:1px solid rgba(125,211,252,.20);
  border-right:1px solid rgba(125,211,252,.20);
}

.hero-title{
  margin:0;
  color:#eef8ff;
  font-size:28px;
  line-height:1.2;
  font-weight:800;
}

.hero-text{
  margin:12px 0 0;
  color:rgba(226,241,255,.68);
  font-size:15px;
  line-height:24px;
}

.content{
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  padding:34px 28px;
  color:#eef8ff;
  border-radius:0 0 22px 22px;
  border:1px solid rgba(125,211,252,.20);
  box-shadow:0 20px 50px rgba(0,0,0,.28);
}

.salutation{
  margin:0 0 14px;
  font-size:15px;
  line-height:24px;
  color:#ffffff;
  font-weight:700;
}

.message{
  margin:0;
  font-size:15px;
  line-height:26px;
  color:rgba(226,241,255,.72);
}

.message p{
  margin:0 0 16px;
}

.button-wrap{
  margin-top:26px;
  margin-bottom:8px;
}

.button{
  display:inline-block;
  padding:14px 28px;
  border-radius:12px;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%) !important;
  color:#ffffff !important;
  font-size:13px;
  font-weight:800;
  text-transform:uppercase;
  letter-spacing:.4px;
  box-shadow:0 14px 30px rgba(37,99,235,.28);
}

.info-box{
  margin-top:28px;
  padding:18px 16px;
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  border-radius:14px;
}

.info-box-title{
  margin:0 0 8px;
  font-size:14px;
  font-weight:800;
  color:#67e8f9;
}

.info-box-text{
  margin:0;
  font-size:13px;
  line-height:22px;
  color:rgba(226,241,255,.66);
}

.bottom-card{
  margin-top:16px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  border-radius:18px;
  padding:24px;
  box-shadow:0 16px 40px rgba(0,0,0,.20);
}

.bottom-title{
  margin:0 0 10px;
  font-size:18px;
  font-weight:800;
  color:#eef8ff;
}

.bottom-text{
  margin:0;
  font-size:14px;
  line-height:24px;
  color:rgba(226,241,255,.70);
}

.bottom-link{
  display:inline-block;
  margin-top:12px;
  color:#67e8f9 !important;
  font-size:14px;
  font-weight:800;
}

.footer{
  padding:18px 10px 0;
  text-align:center;
}

.footer-logo img{
  height:16px;
  width:auto;
  margin:0 auto 10px;
}

.footer-text{
  margin:0;
  font-size:12px;
  line-height:20px;
  color:rgba(226,241,255,.50);
}

@media only screen and (max-width:650px){
  .wrapper{
    padding:16px 10px;
  }

  .header{
    padding:22px 18px;
    border-radius:18px 18px 0 0;
  }

  .hero{
    padding:0 18px 22px;
  }

  .hero-title{
    font-size:23px;
  }

  .hero-text{
    font-size:14px;
    line-height:22px;
  }

  .content{
    padding:24px 18px;
    border-radius:0 0 18px 18px;
  }

  .button{
    width:100%;
    box-sizing:border-box;
    text-align:center;
  }

  .bottom-card{
    padding:18px;
    border-radius:16px;
  }
}

@media only screen and (max-width:420px){
  .hero-title{
    font-size:20px;
  }

  .message{
    font-size:14px;
    line-height:24px;
  }

  .logo img{
    height:34px;
  }
}</style>
</head>
<body>
@php
    $brand = $details['brand'] ?? '#196ED2';
@endphp

<table role="presentation" width="100%" class="wrapper">
    <tr>
        <td align="center">
            <table role="presentation" width="650" class="container">

                <tr>
                    <td class="header">
                        <a href="{{ $details['site_link'] }}" class="logo">
                            <img src="{{ asset(setting('site_logo','global')) }}"
                                 alt="{{ $details['site_title'] ?? 'Logo' }}">
                        </a>
                    </td>
                </tr>

                <tr>
                    <td class="hero">
                        <h1 class="hero-title">{{ $details['title'] }}</h1>

                        @if(!empty($details['sub_title']))
                            <p class="hero-text">{{ $details['sub_title'] }}</p>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="content">
                        @if(!empty($details['salutation']))
                            <p class="salutation">{{ $details['salutation'] }}</p>
                        @endif

                        <div class="message">
                            {!! $details['message_body'] !!}
                        </div>

                        @if(!empty($details['button_link']) && !empty($details['button_level']))
                            <div class="button-wrap">
                                <a href="{{ $details['button_link'] }}"
                                   class="button"
                                   style="background:linear-gradient(135deg, #d6ff2f 0%, #9cff00 100%); color:#05140d;">
                                    {{ $details['button_level'] }}
                                </a>
                            </div>
                        @endif

                        @if(!empty($details['footer_status']))
                            <div class="info-box">
                                <p class="info-box-title">{{ $details['site_title'] ?? 'Notice' }}</p>
                                <p class="info-box-text">{!! $details['footer_body'] !!}</p>
                            </div>
                        @endif
                    </td>
                </tr>

                @if(!empty($details['bottom_status']))
                <tr>
                    <td>
                        <div class="bottom-card">
                            <h3 class="bottom-title">{{ $details['bottom_title'] }}</h3>
                            <p class="bottom-text">{!! $details['bottom_body'] !!}</p>
                            <a href="{{ $details['site_link'] }}" class="bottom-link" style="color:{{ $brand }};">
                                Learn More
                            </a>
                        </div>
                    </td>
                </tr>
                @endif

                <tr>
                    <td class="footer">
                        <div class="footer-logo">
                            <img src="{{ asset(setting('site_logo','global')) }}"
                                 alt="{{ $details['site_title'] ?? 'Logo' }}">
                        </div>
                        <p class="footer-text">
                            © {{ date('Y') }} {{ $details['site_title'] ?? config('app.name') }}.
                            {{ __('All rights reserved.') }}
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Jost',sans-serif;
    background:
        radial-gradient(circle at top right, rgba(180,255,0,0.08), transparent 28%),
        radial-gradient(circle at bottom left, rgba(0,255,170,0.06), transparent 32%),
        linear-gradient(135deg,#031818 0%, #041f1d 45%, #021111 100%);
    color:#ffffff;
    min-height:100vh;
}

/* wrapper */
.gcrig-error-shell{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    position:relative;
    overflow:hidden;
}

/* ambient glow */
.gcrig-error-shell::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at top right, rgba(180,255,0,0.12), transparent 24%),
        radial-gradient(circle at bottom left, rgba(180,255,0,0.05), transparent 30%);
    pointer-events:none;
}

/* glass card */
.gcrig-error-card{
    position:relative;
    z-index:1;
    width:100%;
    max-width:760px;
    text-align:center;
    padding:44px 36px;
    border-radius:28px;
    background:
        linear-gradient(135deg,
        rgba(255,255,255,0.04),
        rgba(255,255,255,0.02));
    border:1px solid rgba(180,255,0,0.14);
    box-shadow:
        0 24px 60px rgba(0,0,0,0.38),
        0 0 0 1px rgba(180,255,0,0.04),
        0 0 25px rgba(180,255,0,0.05);
    backdrop-filter: blur(16px);
}

/* eyebrow */
.gcrig-error-eyebrow{
    display:block;
    font-size:12px;
    font-weight:700;
    letter-spacing:1.5px;
    text-transform:uppercase;
    color:#d6ff2f;
    margin-bottom:14px;
}

/* image */
.unusual-page-img{
    max-width:100%;
    height:220px;
    object-fit:contain;
    margin:0 auto 28px;
    display:block;
    filter: drop-shadow(0 10px 30px rgba(180,255,0,0.08));
}

/* title */
.title{
    font-size:56px;
    line-height:1.08;
    font-weight:700;
    color:#ffffff;
    margin-bottom:18px;
}

/* text */
.description{
    max-width:580px;
    margin:0 auto;
    font-size:18px;
    line-height:1.7;
    color:rgba(255,255,255,0.76);
}

/* button */
.back-to-home-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    min-height:52px;
    padding:0 24px;
    border-radius:14px;
    margin-top:26px;
    background:linear-gradient(135deg,#d6ff2f 0%, #9cff00 100%);
    color:#04140d;
    font-size:14px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 14px 28px rgba(180,255,0,0.18);
    transition:transform .25s ease, box-shadow .25s ease, opacity .25s ease;
}

.back-to-home-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 18px 34px rgba(180,255,0,0.24);
    opacity:.97;
}

.back-to-home-btn:focus{
    outline:none;
    box-shadow:
        0 0 0 4px rgba(180,255,0,0.12),
        0 14px 28px rgba(180,255,0,0.18);
}

/* tablet */
@media (max-width:991.98px){

    .gcrig-error-card{
        max-width:640px;
        padding:36px 24px;
        border-radius:24px;
    }

    .unusual-page-img{
        height:180px;
        margin-bottom:24px;
    }

    .title{
        font-size:42px;
    }

    .description{
        font-size:16px;
    }
}

/* mobile */
@media (max-width:575.98px){

    .gcrig-error-shell{
        padding:16px;
    }

    .gcrig-error-card{
        padding:28px 18px;
        border-radius:20px;
    }

    .gcrig-error-eyebrow{
        font-size:11px;
        margin-bottom:10px;
    }

    .unusual-page-img{
        height:130px;
        margin-bottom:20px;
    }

    .title{
        font-size:30px;
        margin-bottom:14px;
    }

    .description{
        font-size:14px;
        line-height:1.6;
    }

    .back-to-home-btn{
        width:100%;
        min-height:48px;
        border-radius:12px;
        margin-top:20px;
        font-size:13px;
    }
}


*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Jost',sans-serif;
    background:
        radial-gradient(circle at top right, rgba(59,130,246,0.18), transparent 30%),
        radial-gradient(circle at bottom left, rgba(34,211,238,0.10), transparent 34%),
        linear-gradient(135deg,#07111f 0%, #0b1728 48%, #111827 100%);
    color:#ffffff;
    min-height:100vh;
}

/* wrapper */
.gcrig-error-shell{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    position:relative;
    overflow:hidden;
}

/* ambient glow */
.gcrig-error-shell::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at top right, rgba(59,130,246,0.16), transparent 24%),
        radial-gradient(circle at bottom left, rgba(34,211,238,0.10), transparent 30%);
    pointer-events:none;
}

/* glass card */
.gcrig-error-card{
    position:relative;
    z-index:1;
    width:100%;
    max-width:720px;
    text-align:center;
    padding:40px 32px;
    border-radius:26px;
    background:
        linear-gradient(135deg,
        rgba(255,255,255,0.06),
        rgba(255,255,255,0.03));
    border:1px solid rgba(148,163,184,0.18);
    box-shadow:
        0 22px 55px rgba(0,0,0,0.42),
        inset 0 1px 0 rgba(255,255,255,0.04);
    backdrop-filter: blur(18px);
}

/* eyebrow */
.gcrig-error-eyebrow{
    display:block;
    font-size:12px;
    font-weight:700;
    letter-spacing:1.4px;
    text-transform:uppercase;
    color:#60a5fa;
    margin-bottom:12px;
}

/* image */
.unusual-page-img{
    max-width:100%;
    height:200px;
    object-fit:contain;
    margin:0 auto 24px;
    display:block;
    filter: drop-shadow(0 10px 30px rgba(37,99,235,0.18));
}

/* title */
.title{
    font-size:52px;
    line-height:1.1;
    font-weight:800;
    color:#ffffff;
    margin-bottom:16px;
}

/* text */
.description{
    max-width:520px;
    margin:0 auto;
    font-size:16px;
    line-height:1.65;
    color:rgba(226,232,240,0.78);
}

/* button */
.back-to-home-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    min-height:48px;
    padding:0 22px;
    border-radius:12px;
    margin-top:22px;
    background:linear-gradient(135deg,#2563eb 0%,#38bdf8 100%);
    color:#ffffff;
    font-size:13px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 14px 28px rgba(37,99,235,.25);
    transition:all .25s ease;
}

.back-to-home-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 34px rgba(37,99,235,.32);
}

.back-to-home-btn:focus{
    outline:none;
    box-shadow:
        0 0 0 4px rgba(59,130,246,0.18),
        0 14px 28px rgba(37,99,235,.25);
}

/* tablet */
@media (max-width:991.98px){

    .gcrig-error-card{
        max-width:600px;
        padding:32px 22px;
        border-radius:22px;
    }

    .unusual-page-img{
        height:160px;
    }

    .title{
        font-size:40px;
    }

    .description{
        font-size:15px;
    }
}

/* mobile */
@media (max-width:575.98px){

    .gcrig-error-shell{
        padding:16px;
    }

    .gcrig-error-card{
        padding:26px 16px;
        border-radius:18px;
    }

    .gcrig-error-eyebrow{
        font-size:10px;
    }

    .unusual-page-img{
        height:120px;
    }

    .title{
        font-size:28px;
    }

    .description{
        font-size:13px;
    }

    .back-to-home-btn{
        width:100%;
        font-size:12px;
    }
}</style>
</head>

<body>
<div class="gcrig-error-shell">
    <div class="gcrig-error-card">
        <span class="gcrig-error-eyebrow">@yield('eyebrow', 'System Notice')</span>
        @yield('content')
    </div>
</div>
</body>
</html>
<style>
    .bmm-header {
        background-image: url("https://figyusz.k-monitor.hu/img/header-desktop.svg");
    }
</style>
<style>

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Display_Thin.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Display_Thin.otf") format("opentype");
        font-weight: 100;
        font-style: normal
    }

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Text_Bold.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Text_Bold.otf") format("opentype");
        font-weight: 700;
        font-style: normal
    }

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Text_Italic.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Text_Italic.otf") format("opentype");
        font-weight: 400;
        font-style: italic
    }

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Display_Black.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Display_Black.otf") format("opentype");
        font-weight: 900;
        font-style: normal
    }

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Display_Bold_Italic.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Display_Bold_Italic.otf") format("opentype");
        font-weight: 700;
        font-style: italic
    }

    @font-face {
        font-family: Faune;
        src: url("https://figyusz.k-monitor.hu/fonts/Faune/woff2/Faune-Text_Regular.woff2") format("woff2"), url("https://figyusz.k-monitor.hu/fonts/Faune/otf/Faune-Text_Regular.otf") format("opentype");
        font-weight: 400;
        font-style: normal
    }

    * {
        box-sizing: border-box;
    }

    html {
        color: #46009e;
        background-color: #F9F6F6;
        font-family: 'Faune', Arial, sans-serif;
        font-size: 20px;
        line-height: 1.3;
    }

    h3 {
        font-size: 1.4rem;
        font-weight: 700;
    }

    h4 {
        font-size: 1.2rem;
        font-weight: 400;
    }

    .bmm-header {
        background-position-y: bottom;
        background-size: cover;
        min-height: 19vh;
        margin-bottom: 5vh;
    }

    .bmm-header-container {
        display: block;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 5vh;
        margin-left: auto;
        margin-right: auto;
    }

    .bmm-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.8rem;
        margin-top: 5vh;
        min-height: 14vh;
        background-color: #FF3366;
        color: #F9F6F6;
    }

    .bmm-footer-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0px 0.5rem;
        grid-template-areas:
    "c4hu kmonitor"
    "adatkezelesi adatkezelesi";
    }

    .bmm-c4hu {
        grid-area: c4hu;
        align-self: center;
        justify-self: right;
    }

    .bmm-kmonitor {
        grid-area: kmonitor;
        align-self: center;
    }

    .bmm-footer-logo {
        width: 101px;
        margin: 10px 0 0 10px;
    }

    .bmm-adatkezelesi {
        margin: 10px 0 0 10px;
        grid-area: adatkezelesi;
        align-self: center;
        justify-self: center;
    }

    .bmm-container {
        display: block;
        padding-left: 1rem;
        padding-right: 1rem;
        margin-left: auto;
        margin-right: auto;
    }

    .text-align-center {
        text-align: center;
    }

    .flex {
        display: flex;
    }

    .highlighted-text {
        color: #FF3366;
    }

    .center-in-flex {
        margin-left: auto;
        margin-right: auto;
    }

    .bmm-label {
        font-size: 1.2rem;
        font-weight: normal;
    }

    .bmm-data {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .bmm-event-label {
        font-size: 1rem;
        font-weight: normal;
    }

    .bmm-event-data {
        font-size: 1rem;
        font-weight: bold;
    }

    .bmm-event-separator {
        width: 100%;
        border-bottom: #FF3366 solid 1px;
    }
</style>

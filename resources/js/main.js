import { Chart } from "chart.js";

// import flatpickr from "flatpickr";

import flatpickr from "flatpickr";

// import { Spanish } from "flatpickr/dist/l10n/es.js";

// flatpickr(myElem, {
//     locale: Spanish, // locale for this instance only
// });

const Spanish = require("flatpickr/dist/l10n/es.js").default.es;
// or import { Spanish } from "flatpickr/dist/l10n/es.js"
flatpickr.localize(Spanish); // default locale is now Spanish

import resolveConfig from "tailwindcss/resolveConfig";
import tailwindConfig from "../../tailwind.config";

//import component from './components/component';
import dashboardCard01 from "./components/dashboard-card-01";
import dashboardCard02 from "./components/dashboard-card-02";
import dashboardCard03 from "./components/dashboard-card-03";
import dashboardCard05 from "./components/dashboard-card-05";
import dashboardCard06 from "./components/dashboard-card-06";
import dashboardCard08 from "./components/dashboard-card-08";
import dashboardCard09 from "./components/dashboard-card-09";
import analyticsCard01 from "./components/analytics-card-01";
import analyticsCard02 from "./components/analytics-card-02";
import analyticsCard03 from "./components/analytics-card-03";
import analyticsCard04 from "./components/analytics-card-04";
import analyticsCard08 from "./components/analytics-card-08";
import analyticsCard09 from "./components/analytics-card-09";
import analyticsCard10 from "./components/analytics-card-10";
import fintechCard01 from "./components/fintech-card-01";
import fintechCard03 from "./components/fintech-card-03";
import fintechCard04 from "./components/fintech-card-04";
import fintechCard07 from "./components/fintech-card-07";
import fintechCard08 from "./components/fintech-card-08";
import fintechCard09 from "./components/fintech-card-09";
import fintechCard10 from "./components/fintech-card-10";
import fintechCard11 from "./components/fintech-card-11";
import fintechCard12 from "./components/fintech-card-12";
import fintechCard13 from "./components/fintech-card-13";
import fintechCard14 from "./components/fintech-card-14";

import dashboardCard04 from "./components/dashboard-card-04";

const fullConfig = resolveConfig(tailwindConfig);

Chart.defaults.font.family = '"Inter", sans-serif';
Chart.defaults.font.weight = "500";
Chart.defaults.color = fullConfig.theme.colors.slate[400];
Chart.defaults.scale.grid.color = fullConfig.theme.colors.slate[100];
Chart.defaults.plugins.tooltip.titleColor = fullConfig.theme.colors.slate[800];
Chart.defaults.plugins.tooltip.bodyColor = fullConfig.theme.colors.slate[800];
Chart.defaults.plugins.tooltip.backgroundColor = fullConfig.theme.colors.white;
Chart.defaults.plugins.tooltip.borderWidth = 1;
Chart.defaults.plugins.tooltip.borderColor = fullConfig.theme.colors.slate[200];
Chart.defaults.plugins.tooltip.displayColors = false;
Chart.defaults.plugins.tooltip.mode = "nearest";
Chart.defaults.plugins.tooltip.intersect = false;
Chart.defaults.plugins.tooltip.position = "nearest";
Chart.defaults.plugins.tooltip.caretSize = 0;
Chart.defaults.plugins.tooltip.caretPadding = 20;
Chart.defaults.plugins.tooltip.cornerRadius = 4;
Chart.defaults.plugins.tooltip.padding = 8;

Chart.register({
    id: "chartAreaPlugin",

    beforeDraw: (chart) => {
        if (
            chart.config.options.chartArea &&
            chart.config.options.chartArea.backgroundColor
        ) {
            const ctx = chart.canvas.getContext("2d");
            const { chartArea } = chart;
            ctx.save();
            ctx.fillStyle = chart.config.options.chartArea.backgroundColor;

            ctx.fillRect(
                chartArea.left,
                chartArea.top,
                chartArea.right - chartArea.left,
                chartArea.bottom - chartArea.top
            );
            ctx.restore();
        }
    },
});

document.addEventListener("DOMContentLoaded", () => {
    flatpickr(".datepicker", {
        mode: "range",
        static: true,
        monthSelectorType: "static",
        dateFormat: "M j, Y",
        defaultDate: [new Date().setDate(new Date().getDate() - 6), new Date()],
        prevArrow:
            '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
        nextArrow:
            '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
        onReady: (selectedDates, dateStr, instance) => {
            instance.element.value = dateStr.replace("to", "-");
            const customClass = instance.element.getAttribute("data-class");
            instance.calendarContainer.classList.add(customClass);
        },
        onChange: (selectedDates, dateStr, instance) => {
            instance.element.value = dateStr.replace("to", "-");
        },
    });
    flatpickr(".inputDate", {
        mode: "single",
        disableMobile: "true",
        dateFormat: "Y-m-d",
        prevArrow:
            '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
        nextArrow:
            '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    });

    var hoy = new Date();

    var hora = hoy.getHours() + ":" + hoy.getMinutes();

    // flatpickr(".inputTime", {
    //     enableTime: true,
    //     noCalendar: true,
    //     dateFormat: "H:i",
    //     time_24hr: true,
    //     disableMobile: "true",
    //     defaultDate: hora,
    // });

    dashboardCard01();
    dashboardCard02();
    dashboardCard03();
    dashboardCard04();
    dashboardCard05();
    dashboardCard06();
    dashboardCard08();
    dashboardCard09();
    analyticsCard01();
    analyticsCard02();
    analyticsCard03();
    analyticsCard04();
    analyticsCard08();
    analyticsCard09();
    analyticsCard10();
    fintechCard01();
    fintechCard03();
    fintechCard04();
    fintechCard07();
    fintechCard08();
    fintechCard09();
    fintechCard10();
    fintechCard11();
    fintechCard12();
    fintechCard13();
    fintechCard14();
});

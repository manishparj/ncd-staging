const months = [
    "January","February","March","April","May","June",
    "July","August","September","October","November","December"
];

const days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];

const today = new Date();

let currentMonth =
    today.getFullYear() === year
        ? today.getMonth()   // current month (0–11)
        : 0;                 // fallback to January if not 2026


renderCalendar();

function renderCalendar() {

    document.getElementById("monthYear").innerText =
        months[currentMonth] + " " + year;

    document.getElementById("prevBtn").disabled = currentMonth === 0;
    document.getElementById("nextBtn").disabled = currentMonth === 11;

    let html = "<table><tr>";
    days.forEach(d => html += `<th>${d}</th>`);
    html += "</tr>";

    let firstDay = (new Date(year, currentMonth, 1).getDay() + 6) % 7;
    let totalDays = new Date(year, currentMonth + 1, 0).getDate();

    let date = 1;
    for (let i = 0; i < 6; i++) {
        html += "<tr>";
        for (let j = 0; j < 7; j++) {

            if (i === 0 && j < firstDay) {
                html += "<td></td>";
            } else if (date > totalDays) {
                html += "<td></td>";
            } else {

                let fullDate = `${year}-${String(currentMonth+1).padStart(2,'0')}-${String(date).padStart(2,'0')}`;
                let dow = new Date(year, currentMonth, date).getDay();

                let cls = "";
let tip = "";

// Detect today's date
const today = new Date();
const isToday =
    today.getFullYear() === year &&
    today.getMonth() === currentMonth &&
    today.getDate() === date;


                if (holidays[fullDate]) {
    let h = holidays[fullDate];
    cls = h.type === "GH" ? "gazetted" : "restricted";
    tip = `${h.type} : ${h.name}`;
} else if (dow === 0 || dow === 6) {
    cls = "weekend";
    tip = "";
}

                // Add today highlight
if (isToday) {
    cls += " today";
    tip = tip ? `Today | ${tip}` : "Today";
}

html += `<td class="${cls}">
            <div class="day-number">${date}</div>
            ${tip ? `<div class="tooltip">${tip}</div>` : ""}
         </td>`;

                date++;
            }
        }
        html += "</tr>";
        if (date > totalDays) break;
    }

    html += "</table>";
    document.getElementById("calendar").innerHTML = html;
}

function nextMonth() {
    if (currentMonth < 11) {
        currentMonth++;
        renderCalendar();
    }
}

function prevMonth() {
    if (currentMonth > 0) {
        currentMonth--;
        renderCalendar();
    }
}

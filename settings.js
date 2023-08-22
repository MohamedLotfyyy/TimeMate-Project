const SETTINGS_IDS = [
    "timezone",
    "c:checkinreminders",
    "c:deadlines",
    "c:personalevents",
    "c:securitychecks",
    "c:resetmonthly",
    "c:locationservices",
    "c:allowimporting",
    "c:lightmode",
    "c:darkmode"
];

const DEFAULT_SETTINGS = {
    "timezone": "0",
    "c:checkinreminders": true,
    "c:deadlines": true,
    "c:personalevents": true,
    "c:securitychecks": true,
    "c:resetmonthly": true,
    "c:locationservices": true,
    "c:allowimporting": true,
    "c:lightmode": true,
    "c:darkmode": false
};

async function saveSettings() {
    const settings = SETTINGS_IDS.reduce((obj, id) => { const el = document.getElementById(id); obj[id] = id.startsWith("c:") ? el.checked : el.value; return obj; }, { v: 1 });

    const res = await fetch("/savesettings.php", {
        method: "POST",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(settings)
    });

    if (res.status != 200) {
        alert("error saving settings");
    } else {
        alert("Settings saved successfully");
    }
}

async function loadSettings() {
    const res = await fetch("/getsettings.php", {
        method: "GET",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        }
    });

    if (res.status == 403) {
        window.location = "login.php";
        return;
    } else if (res.status != 200) {
        alert("error loading settings");
        return;
    }

    let settings = await res.text();
    if (settings == "") {
        settings = DEFAULT_SETTINGS;
    } else {
        settings = JSON.parse(settings);
    }
``
    for (const id of SETTINGS_IDS) {
        if (!id in settings) {
            settings[id] = DEFAULT_SETTINGS[id];
        }

        const el = document.getElementById(id);
        if (id.startsWith("c:")) {
            el.checked = settings[id];
        } else {
            el.value = settings[id];
        }
    }
}

document.getElementById("saveButton").addEventListener("click", saveSettings);
document.addEventListener("DOMContentLoaded", loadSettings);
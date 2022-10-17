function main() {

    const $$ = (s) => document.querySelector(s);
    const $$$ = (s) => [...document.querySelectorAll(s)];

    function onRadioUpdate() {
        const selected = $$(".sales input[name=choice]:checked").value;
        const dateInput = $$(".sales input[type=date]");
        console.log(dateInput, selected);
        if(selected == "day") {
            dateInput.required = true;
        } else {
            dateInput.required = false;
        }
    }

    $$$(".sales input[type=radio]").forEach(e => {
        e.addEventListener("input",onRadioUpdate)
        e.addEventListener("change",onRadioUpdate)
    });
}

main();
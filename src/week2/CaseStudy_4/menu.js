function main(){
    

    const $$ = (s) => document.querySelector(s);
    const $$$ = (s) => [...document.querySelectorAll(s)];

    function getElementAsInt(selector) {
        const ele = $$(selector);
        const raw = ele?.value ?? "0";
        const v = raw.trim() == "" ? "0" : raw.trim();
        return parseInt(v);
    }
    function getElementAsFloat(selector) {
        const ele = $$(selector);
        const raw = ele?.value ?? "0";
        const v = raw.trim() == "" ? "0" : raw.trim();
        return parseFloat(v);
    }

    function updatePrice(element) {
        const i = element.id;
        const amount = getElementAsInt(`#${i} .p-int`);

        const price = getElementAsFloat(`input[name=${i}]:checked`);

        const total = (amount * price).toFixed(2);
        $$(`#${i} .cost`).innerHTML = `$ ${total}`;
        return parseFloat(total);
    }
    

    function updatePrices() {
        const sum = $$$(".coffee-row").map(ele => updatePrice(ele)).reduce((a,b)=> a + b,0);
        const total = sum.toFixed(2);
        $$("#total-result").innerHTML = `Total: $ ${total}`;

    }
    function numberOnly(ele) {
        ele.addEventListener("input", (event) => {
            ele.value = ele.value.split('')
                .filter(x => x >= "0" && x <= "9").join('');
        })
        return ele;
    }

    function addUpdateListener(ele) {
        ele.addEventListener("change", ()=> updatePrices())
        ele.addEventListener("input", ()=> updatePrices())
        return ele;
    }
    


    function control(minus, plus, target) {
        const m = $$(minus);
        const p = $$(plus);
        const t = $$(target);
    
        m.addEventListener("click", () => {
            const v = getElementAsInt(target);
            t.value = Math.max(0, v - 1).toString();
            updatePrices();
        })
    
        p.addEventListener("click", () => {
            const v = getElementAsInt(target);
            t.value = (v + 1).toString();
            updatePrices();
        })
    }
    
    $$$(".p-int")
        .forEach(e => addUpdateListener(numberOnly(e)));
    $$$("input[type=radio]")
        .forEach(e => addUpdateListener(e));
    
    $$$(".coffee-row")
        .forEach(cr => {
            const i = cr.id;
            control(`#${i} .minus`, `#${i} .plus`, `#${i} .p-int`);
        });
}

main();
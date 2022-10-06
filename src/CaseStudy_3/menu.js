function main(){
    

    const $$ = (s) => document.querySelector(s);

    function getElementAsInt(selector) {
        const ele = $$(selector);
        const raw = ele.value ?? "0";
        const v = raw.trim() == "" ? "0" : raw.trim();
        return parseInt(v);
    }

    function updatePrice(select, amount, price) {
        console.log(select, amount, price);
        const s = $$(select);
        const total = (amount * price).toFixed(2);
        s.innerHTML = `$ ${total}`;
        return parseFloat(total);
    }
    

    function updatePrices() {
        const t1 = updatePrice("#jj .cost", getElementAsInt("#jj .p-int"), getJustJava());
        const t2 = updatePrice("#cal .cost", getElementAsInt("#cal .p-int"), getCafeAuLait());
        const t3 = updatePrice("#icap .cost", getElementAsInt("#icap .p-int"), getIceCappuccino());

        const total = (t1 + t2 + t3).toFixed(2);
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
    
    function getJustJava(){
        return parseInt($$("#jj").getAttribue("price") ?? "2");
        
    }
    function getCafeAuLait(){
        const cal = $$("input[name=cafe-au-lait]:checked")?.value ?? "";
        const ps = parseInt($$("#cal").getAttribue("price-s") ?? "2");
        const pd = parseInt($$("#cal").getAttribue("price-d") ?? "3");
        return cal == "" ? 0 : cal == "cafe-au-lait-single" ? ps : pd;
    }

    function getIceCappuccino() {
        const icap = $$("input[name=ice-cap]:checked")?.value ?? "";
        const ps = parseInt($$("#icap").getAttribue("price-s") ?? "4.75");
        const pd = parseInt($$("#icap").getAttribue("price-d") ?? "5.75");
        return icap == "" ? 0 : icap == "ice-cap-single" ? ps : pd;
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
    
    [...document.querySelectorAll(".p-int")]
        .forEach(e => addUpdateListener(numberOnly(e)));
    [...document.querySelectorAll("input[type=radio]")]
        .forEach(e => addUpdateListener(e));
    
    
    control("#jj .minus", "#jj .plus", "#jj .p-int");
    control("#cal .minus", "#cal .plus", "#cal .p-int");
    control("#icap .minus", "#icap .plus", "#icap .p-int");
}

main();
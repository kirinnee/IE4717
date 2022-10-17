function admin() {

    const $$$ = (s) => [...document.querySelectorAll(s)];
    const $$ = (s) => document.querySelector(s);

    function updateField(id, selector, validator) {
        const input = $$(`#${id} ${selector} input`);
        const valid = validator(input.value);
        const check = $$(`#${id} ${selector} .check`);
        const msg = $$(`#${id} ${selector} .error-msg`);
        const select = $$(`#${id} .edit-mode`);
        msg.innerHTML = valid === "" ? "no error" : valid;
        msg.style.opacity = valid !== "" && select.checked ? "1" : "0";
        check.style.opacity = valid === "" && select.checked ? "1" : "0";
    }


    function updateAddField(id, selector, validator) {
        const input = $$(`#${id} ${selector} input`);
        const valid = validator(input.value);
        const check = $$(`#${id} ${selector} .check`);
        const msg = $$(`#${id} ${selector} .error-msg`);
        msg.innerHTML = valid === "" ? "no error" : valid;
        msg.style.opacity = valid !== "" ? "1" : "0";
        check.style.opacity = valid === "" ? "1" : "0";
    }
    function priceOnly(ele) {
        ele.addEventListener("input", () => {
            if (!!ele.value.match(/^\d*\.?\d?\d?$/)) {
                ele.setAttribute("pre", ele.value);
            } else {
                ele.value = ele.getAttribute("pre");
                ele.dispatchEvent(new Event('input', {
                    bubbles: true,
                    cancelable: true
                }))
            }
        })
        return ele;
    }

    function UpdateAllEditable(id) {
        const select = $$(`#${id} .edit-mode`);
        const canEdit = !!select.checked;

        const coffeeDeleteCheckbox = $$(`#${id} .delete-coffee input[type=checkbox]`);
        const coffeeDeleted = coffeeDeleteCheckbox.checked;
        
        // Update Delete field
        coffeeDeleteCheckbox.disabled = !canEdit;

        // Update Name field
        const nameInput = $$(`#${id} .coffee-name input`);
        nameInput.disabled = !canEdit || coffeeDeleted;

        // Update Desc field
        const descInput = $$(`#${id} .coffee-desc .desc`);
        descInput.contentEditable = canEdit && !coffeeDeleted;

        const descHiddenInput = $$(`#${id} .coffee-desc input`);
        descHiddenInput.disabled = !canEdit || coffeeDeleted;

        if(coffeeDeleted) {
            nameInput.classList.remove("display");
            descInput.classList.remove("display");
        } else {
            nameInput.classList.add("display");
            descInput.classList.add("display");
        }

        $$$(`#${id} .edit`).forEach(ele => {
            ele.style.opacity = canEdit? 1 : 0;
            ele.style.borderColor = canEdit ? "black" : "transparent";
        })

        // Update Variants
        $$$(`#${id} .coffee-variant-row`).forEach(variant => {
            const variantDeleteCheckbox = $$(`#${variant.id} .delete-variant input[type=checkbox]`);

            variantDeleteCheckbox.disabled = !canEdit || coffeeDeleted;

            const variantDeleted = variantDeleteCheckbox.checked;
            const variantName = $$(`#${variant.id} .coffee-variant input`);
            variantName.disabled = !canEdit || coffeeDeleted || variantDeleted;

            const priceName = $$(`#${variant.id} .coffee-price input`);
            priceName.disabled = !canEdit || coffeeDeleted || variantDeleted;

            if(coffeeDeleted || variantDeleted) {
                variantName.classList.remove("display");
                priceName.classList.remove("display");
            } else {
                variantName.classList.add("display");
                priceName.classList.add("display");
            }
        })

        // Update Additional Coffee Variant Rows 
        $$$(`#${id} .add-coffee-variant-row`).forEach(variant => {
            const variantName = $$(`#${variant.id} .add-coffee-variant input`);
            variantName.disabled = !canEdit || coffeeDeleted;

            const priceName = $$(`#${variant.id} .add-coffee-price input`);
            priceName.disabled = !canEdit || coffeeDeleted ;

            if(coffeeDeleted) {
                variantName.classList.remove("display");
                priceName.classList.remove("display");
            } else {
                variantName.classList.add("display");
                priceName.classList.add("display");
            }
        })
    }

     // Add Coffee
     $$(`#add-coffee`).addEventListener("click", () => {
                
        const table = $$("#additional-coffee");
        const count = parseInt(table.getAttribute("elementCount"));
        const id = count + 1;
        const row = document.createElement("tr");
        row.classList.add("add-coffee-row");
        row.id = `add-coffee-${id}`;

        const rowContent = `
<td>
    <div class="coffee-name">
    <div>
        <input class="display" name="add-coffee-name-${id}" value="Coffee Name">
        <span class="check">✅</span>
    <div>
    <div class="error-msg">
        sine errir
    </div>
    </div>
</td>
<td>
    <div class="coffee-desc">
    <div class="f-h f-center"> 
        <div class="desc display" contenteditable="true">
            Coffee Description
        </div>
        <div class="check">✅</div>
    </div>
    <div class="error-msg">
        sine errir
    </div>
    <input class="desc-value" name="add-coffee-desc-${id}" 
        value="Coffee Description" style="display: none;">
    </div>
    <table class="additional m-a" id="coffee-additional-${id}" coffeeId="${id}" elementCount="1" eleSize="1">
        <tr class="add-add-coffee-variant-row" id="add-add-coffee-variant-${id}-1">
            <td>
                <div id="add-add-coffee-variant-${id}-1" class="add-coffee-variant">
                    <div>
                        <input class="variant-name display" name="add-add-coffee-variant-name-${id}-1"> 
                        <span class="check">✅</span>
                    <div>
                    <div class="error-msg">
                        sine errir
                    </div>
                </div>
            </td>
            <td>
                <div id="add-add-coffee-price-${id}-1" class="add-coffee-price">
                    <div>
                        $ <input class="price display" name="add-add-coffee-price-${id}-1" value="0" pre="0"> 
                        <span class="check">✅</span>
                    <div>
                    <div class="error-msg">
                        sine errir
                    </div>
                </div>
                
            </td>
            <td class="edit add-delete-variant" id="add-add-delete-variant-${id}-1">
                Remove
            </td>
        </tr>
    </table> 
    <div class="add-button m-l edit variant" id="add-add-button-${id}" coffeeId="${id}">Add</div>
    </div>
</td>
<td class="add-button" id="add-delete-coffee-${id}" coffeeId="${id}">
    Remove
</td>
`
        row.innerHTML = rowContent;
        table.appendChild(row);

        // increment count
        table.setAttribute("elementCount", count + 1);

        // Add Validator for name
        updateAddField(row.id, ".coffee-name", coffeeNameValidator);
        $$(`#${row.id} .coffee-name input`).addEventListener("input", () => {
            updateAddField(row.id, ".coffee-name", coffeeNameValidator);
        });
        // Add Validator for description
        updateAddField(row.id, ".coffee-desc", coffeeDescriptionValidator);
        const fakeDesc = $$(`#${row.id} .coffee-desc div[contenteditable=true]`);        
        fakeDesc.addEventListener("input", () => {
            $$(`#${row.id} .desc-value`).value = fakeDesc.innerText;
            updateAddField(row.id, ".coffee-desc", coffeeDescriptionValidator);
        });

        // Add validator for additional additional variant fields
        updateAddField(row.id, ".add-coffee-variant", coffeeNameValidator);
        updateAddField(row.id, ".add-coffee-price", coffeePriceValidator);
        $$(`#${row.id} .add-coffee-variant input`).addEventListener("input", () => {
            updateAddField(row.id, ".add-coffee-variant", coffeeNameValidator);
        });
        const priceInput = $$(`#${row.id} .add-coffee-price input`);
        priceInput.addEventListener("input", () => {
            updateAddField(row.id, ".add-coffee-price", coffeePriceValidator);
        });
        priceOnly(priceInput)

        // Remove Variant Row
        $$(`#add-add-delete-variant-${id}-1`).addEventListener("click", ()=> {
            const variantTable = $$(`#coffee-additional-${id}`);
            const size = parseInt(variantTable.getAttribute('eleSize'));
            if(size > 1) {
                $$(`#add-add-coffee-variant-${id}-1`).remove();
                variantTable.setAttribute("eleSize", size - 1);
            }
        })

        // Remove Row 
        $$(`#add-delete-coffee-${id}`).addEventListener("click", () => {
            $$(`#${row.id}`).remove();
        })

        // Additional Variant operations
        $$(`#add-add-button-${id}`).addEventListener("click", () => {
            const variantTable = $$(`#coffee-additional-${id}`);
            const count = parseInt(variantTable.getAttribute('elementCount'));
            const size = parseInt(variantTable.getAttribute('eleSize'));
            
            const vid = count + 1;
            const vRow = document.createElement("tr");
            
            vRow.classList.add("add-add-coffee-variant-row")
            vRow.id = `add-add-coffee-variant-${id}-${vid}`;

            const vRowContent = `
<td>
    <div id="add-add-coffee-variant-${id}-${vid}" class="add-coffee-variant">
        <div>
            <input class="variant-name display" name="add-add-coffee-variant-name-${id}-${vid}"> 
            <span class="check">✅</span>
        <div>
        <div class="error-msg">
            sine errir
        </div>
    </div>
</td>
<td>
    <div id="add-add-coffee-price-${id}-${vid}" class="add-coffee-price">
        <div>
            $ <input class="price display" name="add-add-coffee-price-${id}-${vid}" value="0" pre="0"> 
            <span class="check">✅</span>
        <div>
        <div class="error-msg">
            sine errir
        </div>
    </div>
    
</td>
<td class="edit add-delete-variant" id="add-add-delete-variant-${id}-${vid}">
    Remove
</td>
            `;
            vRow.innerHTML = vRowContent;
            variantTable.appendChild(vRow);
            variantTable.setAttribute('elementCount', vid);
            variantTable.setAttribute('eleSize', size + 1);

            // Add events
            // Validation Events
            updateAddField(row.id, `#add-add-coffee-variant-${id}-${vid}`, coffeeNameValidator);
            updateAddField(row.id, `#add-add-coffee-price-${id}-${vid}`, coffeePriceValidator);
            $$(`#${row.id} #add-add-coffee-variant-${id}-${vid} input`).addEventListener("input", () => {
                updateAddField(row.id, `#add-add-coffee-variant-${id}-${vid}`, coffeeNameValidator);
            });
            const priceInput = $$(`#${row.id} #add-add-coffee-price-${id}-${vid} input`);
            priceInput.addEventListener("input", () => {
                updateAddField(row.id, `#add-add-coffee-price-${id}-${vid}`, coffeePriceValidator);
            });
            priceOnly(priceInput)

            $$(`#add-add-delete-variant-${id}-${vid}`).addEventListener("click", ()=> {
                const variantTable = $$(`#coffee-additional-${id}`);
                const size = parseInt(variantTable.getAttribute('eleSize'));
                if(size > 1) {
                    $$(`#add-add-coffee-variant-${id}-${vid}`).remove();
                    variantTable.setAttribute("eleSize", size - 1);
                }
            })
    
        });

    });

    $$$(".coffee-row")
        .forEach(x => {
            const i = x.id;

            const nameInput = $$(`#${i} .coffee-name input`);
            nameInput.addEventListener("input", () => updateField(i, ".coffee-name", coffeeNameValidator));

            $$$(`#${i} .coffee-variant`).forEach(variant => {
                const id = variant.id;
                $$(`#${i} #${id} input`).addEventListener("input", () => updateField(i, `#${id}`, coffeeNameValidator));
            });

            $$$(`#${i} .coffee-price`).forEach(price => {
                const id = price.id;
                const priceInput = $$(`#${i} #${id} input`)
                priceInput.addEventListener("input", () => updateField(i, `#${id}`, coffeePriceValidator));
                priceOnly(priceInput);
            });


            const select = $$(`#${i} .edit-mode`);
            const desc = $$(`#${i} .desc`);

            $$$(`#${i} .delete-variant input[type=checkbox]`)
                .forEach(e => e.addEventListener("input", () => {
                    UpdateAllEditable(i)
                }))
            $$(`#${i} .delete-coffee input[type=checkbox]`).addEventListener("input", () => {
                UpdateAllEditable(i)
            });


            // Add variant
            $$(`#${i} .add-button.variant`).addEventListener("click", () => {
                const table = $$(`#${i} .additional`);
                const count = parseInt(table.getAttribute("elementCount"))
                const coffeeId = table.getAttribute("coffeeId");
                const id = `${coffeeId}-${count+1}`;
                const rowElement = document.createElement("tr");
                rowElement.classList.add("add-coffee-variant-row")
                rowElement.id = `add-coffee-variant-row-${id}`;
                
const row = `
<td>
    <div id="add-coffee-variant-${id}" class="add-coffee-variant">
        <div>
            <input disabled class="variant-name display" name="add-coffee-variant-name-${id}"> 
            <span class="check">✅</span>
        <div>
        <div class="error-msg">
            sine errir
        </div>
    </div>
</td>
<td>
    <div id="add-coffee-price-${id}" class="add-coffee-price">
        <div>
            $ <input disabled  class="price display" name="add-coffee-price-${id}" value="0" pre="0"> 
            <span class="check">✅</span>
        <div>
        <div class="error-msg">
            sine errir
        </div>
    </div>
    
</td>
<td class="edit add-delete-variant" id="add-delete-variant-${id}">
    Remove
</td>
`               ;
                rowElement.innerHTML = row;
                table.appendChild(rowElement);
                table.setAttribute("elementCount", count + 1);

                // Attach validaiton listeners
                $$$(`#${i} .add-coffee-variant`).forEach(variant => {
                    updateField(i, `#${variant.id}`, coffeeNameValidator);
                    $$(`#${i} #${variant.id} input`).addEventListener("input", () => {
                        updateField(i, `#${variant.id}`, coffeeNameValidator);
                    })
                });

                $$$(`#${i} .add-coffee-price`).forEach(price => {
                    const addPriceInput = $$(`#${i} #${price.id} input`);
                    priceOnly(addPriceInput);
                    updateField(i, `#${price.id}`, coffeePriceValidator);
                    addPriceInput.addEventListener("input", () => {
                        updateField(i, `#${price.id}`, coffeePriceValidator);
                    });
                });
                $$(`#add-delete-variant-${id}`).addEventListener("click", () => {
                    $$(`#add-coffee-variant-row-${id}`).remove();
                });
                UpdateAllEditable(i);
            })


           

            // On check-box
            select.addEventListener("input", () => {

                // Trigger Validation 
                updateField(i, ".coffee-name", coffeeNameValidator)
                updateField(i, ".coffee-desc", coffeeDescriptionValidator)
                $$$(`#${i} .coffee-variant`).forEach(variant => {
                    updateField(i, `#${variant.id}`, coffeeNameValidator);
                });
                $$$(`#${i} .coffee-price`).forEach(price => {
                    updateField(i, `#${price.id}`, coffeePriceValidator);
                });

                $$$(`#${i} .add-coffee-variant`).forEach(variant => {
                    updateField(i, `#${variant.id}`, coffeeNameValidator);
                });
                $$$(`#${i} .add-coffee-price`).forEach(price => {
                    updateField(i, `#${price.id}`, coffeePriceValidator);
                });
                updateField(i, ".coffee-variant", coffeeNameValidator)
                updateField(i, ".coffee-price", coffeePriceValidator)

                UpdateAllEditable(i);
                
            })

            desc.addEventListener("input", () => {
                $$(`#${i} .desc-value`).value = desc.innerText;
                updateField(i, ".coffee-desc", coffeeDescriptionValidator)
            });

        });

}


admin();


function validateOne(selector, validator) {
    const $$$ = (s) => [...document.querySelectorAll(s)];
    return [...$$$(selector)].every(ele => ele.disabled || validator(ele.value) === "")
}

function validateAll() {
    return true;
    const args = [
        [".coffee-row .coffee-name input", coffeeNameValidator], 
        [".coffee-row .coffee-desc input", coffeeDescriptionValidator],
        [".coffee-variant-row .coffee-variant input", coffeeNameValidator],
        [".coffee-variant-row .coffee-price input", coffeePriceValidator],

        [".add-coffee-variant-row .add-coffee-variant input", coffeeNameValidator],
        [".add-coffee-variant-row .add-coffee-price input", coffeePriceValidator],

        [".add-coffee-row .coffee-name input", coffeeNameValidator], 
        [".add-coffee-row .coffee-desc input", coffeeDescriptionValidator],
        [".add-add-coffee-variant-row .add-coffee-variant input", coffeeNameValidator],
        [".add-add-coffee-variant-row .add-coffee-price input", coffeePriceValidator],
    ];
    return args
        .every(([selector, validator]) => validateOne(selector, validator));

}
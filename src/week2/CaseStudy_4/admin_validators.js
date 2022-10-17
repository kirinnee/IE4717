function coffeeNameValidator(name) {
    if(!!name.match(/^[a-zA-Z][^\s]*(\s*[^\s]+)*$/) && name.length < 64) {
        return "";
    }
    if (name.length >= 64 ) {
        return "Name cannot exceed 63 characters";
    }
    if(!!name.match(/^[^a-zA-Z].*$/)) {
        return "First character can only be alphabet"
    }
    if(!!name.match(/^.*\s$/)) {
        return "Cannot end with space";
    }
    return "Name cannot be empty";
}

function coffeeDescriptionValidator(desc) {

    if (desc.length >= 4096 ) {
        return "Name cannot exceed 4095 characters";
    }
    if(!!desc.match(/^.*\s$/)) {
        return "Cannot end with space";
    }
    if (desc.length == 0) {
        return "Description cannot be empty";
    }
    return ""
}


function coffeePriceValidator(price) {
    const arr = price.split("."); 
    const [dollar, cent]= arr;
    if(arr.length != 1 && arr.length != 2) {
        return "Only can have a single decimal point"
    }

    if(cent != null && cent.length > 2) {
        return "Only can have 2 digit in decimal place"
    }
    if (price.length == 0) {
        return "Cannot have empty price";
    }
    if(dollar.length == 0) {
        return "Missing dollar section";
    }
    if(!price.match(/^\d*\.?\d?\d?$/)) {
        return "Needs to be in money format";
    }
    if(dollar.length > 1 && dollar[0] == '0') {
        console.log("hit");
        return "Cannot start with 0";
    }
    if(dollar.length > 3) {
        return "Max price is $999.99";
    }
    if(!!price.match(/^.*\.$/)){
        return "Cannot end with .";
    }
    return "";
}
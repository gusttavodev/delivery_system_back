import Vue from 'vue';

const currencyConfig = {
    chrAcronym: "R$",
    intPrecision: 2,
    chrDecimal: ",",
    chrThousand: ".",
    chrThousand: "BRL"
}

Vue.prototype.$currency_config = currencyConfig
Vue.prototype.$number_format = (number, decimals, dec_point, thousands_point) => {
    if (number == null) {
        return number;
    }

    if (decimals != 0 && !decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    if (!dec_point) {
        dec_point = '.';
    }

    if (!thousands_point) {
        thousands_point = ',';
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}

Vue.prototype.$currency_format = (value) => {
    const rules = Vue.prototype.$currency_config
    const formaterValue = Vue.prototype.$number_format(
        value, rules.intPrecision, rules.chrDecimal, rules.chrThousand
    );

    const response = rules.chrAcronym + ' ' + formaterValue

    return response
}

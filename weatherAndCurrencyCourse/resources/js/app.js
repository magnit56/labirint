require('./bootstrap');

// честно говоря я не за подход "возврат варварской верстки,
// но боюсь времени подумать как сделать лучше нет
// уж очень долго создавать элементы и привязывать их друг к другу
import * as $ from 'jquery';

const renderWeather = (weather) => {
    return "<div class=\"card\" style=\"width: 18rem;\">\n" +
        "        <div class=\"card-body\">\n" +
        `            <p class=\"card-text\">${weather.name} ${weather.date}</p>\n` +
        `            <h5 class=\"card-title\">Температура: ${weather.temperature}</h5>\n` +
        `            <h5 class=\"card-title\">Ощущается как: ${weather.feels}</h5>\n` +
        `            <p class=\"card-text\">${weather.description}</p>\n` +
        "        </div>\n" +
        "    </div>"
}

const renderCurrencies = (currencies) => {
    return currencies.reduce((acc, currency) => {
        return acc + renderCurrency(currency)
    }, '')
}

const renderCurrency = (currency) => {
    return "<div class=\"card\" style=\"width: 18rem;\">\n" +
        "        <div class=\"card-body\">\n" +
        `            <p class=\"card-text\">1 ${currency.CharCode} = ${currency.Value} RUB</p>\n` +
        `            <p class=\"card-text\">${currency.Name}</p>\n` +
        "        </div>\n" +
        "    </div>"
}

$(document).ready(function() {
    $('button.update').click(() => {
        $.ajax("http://localhost:8000/api/weather")
            .done(function (data) {
                $('.weather').html(renderWeather(JSON.parse(data)))
            })
            .fail(function () {
                // Как-то обрабатываем ошибку
            });
        $.ajax("http://localhost:8000/api/currencies")
            .done(function (data) {
                $('.currencies').html(renderCurrencies(JSON.parse(data)))
            })
            .fail(function () {
                // Как-то обрабатываем ошибку
            });
    });
});

<?php
$url1 = 'http://80.90.188.45/euro_to_usd.txt';
$url2 = 'http://80.90.188.45/usdt_to_rub.txt';
$url3 = 'http://80.90.188.45/cny_to_usd.txt';

$data1 = file_get_contents($url1);
$data2 = file_get_contents($url2);
$data3 = file_get_contents($url3);

// Убедимся, что данные загружены и не пустые
if ($data1 === false || $data2 === false || $data3 === false) {
  die('Ошибка загрузки данных');
}
?>
<section class="calculate">
  <div class="container">
    <div class="calculate__row">
      <div class="calculate__wrap">
        <div class="calculate__title">
          <h2>Рассчитайте стоимость международного перевода</h2>
        </div>
        <div class="calculate__rates">
          <div class="calculate__rate calculate__rate_usd">
            <img src="<?php echo get_template_directory_uri(); ?>/img/calc-usd.png" alt="">
            <span>USD <span class="rate-value"></span></span>
          </div>
          <div class="calculate__rate calculate__rate_eur">
            <img src="<?php echo get_template_directory_uri(); ?>/img/calc-euro.png" alt="">
            <span>EUR <span class="rate-value"></span></span>
          </div>
          <div class="calculate__rate calculate__rate_cyn">
            <img src="<?php echo get_template_directory_uri(); ?>/img/calc-cn.png" alt="">
            <span>CYN <span class="rate-value"></span></span>
          </div>
        </div>
      </div>
      <div class="calculate__wrap calculate__wrap_width">
        <div class="calculate__buttons">
          <button id="buyButton"
            class="btn-reset calculate__button calculate__button_buy calculate__button_active">Купить</button>
          <button id="sellButton" class="btn-reset calculate__button calculate__button_sell">Продать</button>
        </div>
        <div class="calculate__buttons">
          <button id="usdButton"
            class="btn-reset calculate__button calculate__button_usd calculate__button_active">USD</button>
          <button id="eurButton" class="btn-reset calculate__button calculate__button_eur">EUR</button>
          <button id="cynButton" class="btn-reset calculate__button calculate__button_cyn">CYN</button>
        </div>
      </div>
      <div id="buyColumn" class="calculate__column calculate__column_active">
        <div class="calculate__wrapper">
          <div class="calculate__head">Сколько вы хотите купить?</div>
          <div class="calculate__value" id="buyValue">1 $</div>
          <input type="range" id="buyRange" name="valute" class="calculate__range slider-progress" step="1" min="1"
            max="100000" value="1">
        </div>
        <div class="calculate__wrapper">
          <div class="calculate__head">Сумма сделки</div>
          <div class="calculate__value calculate__value_summ" id="buySum">100.45 </div>
          <button class="btn-reset calculate__button calculate__button_tg">Обменять валюту</button>
        </div>
      </div>
      <div id="sellColumn" class="calculate__column">
        <div class="calculate__wrapper">
          <div class="calculate__head">Сколько вы хотите продать?</div>
          <div class="calculate__value" id="sellValue">1 $</div>
          <input type="range" id="sellRange" name="valute" class="calculate__range slider-progress" step="1" min="1"
            max="100000" value="1">
        </div>
        <div class="calculate__wrapper">
          <div class="calculate__head">Сумма сделки</div>
          <div class="calculate__value calculate__value_summ" id="sellSum">100.45</div>
          <button class="btn-reset calculate__button calculate__button_tg">Обменять валюту</button>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  for (let e of document.querySelectorAll('input[type="range"].slider-progress')) {
    e.style.setProperty('--value', e.value);
    e.style.setProperty('--min', e.min == '' ? '0' : e.min);
    e.style.setProperty('--max', e.max == '' ? '100000' : e.max);
    e.addEventListener('input', () => e.style.setProperty('--value', e.value));
  }

  // Передаем данные из PHP в JavaScript
  const euroToUsd = parseFloat(<?php echo $data1; ?>);
  const usdtToRub = parseFloat(<?php echo $data2; ?>);
  const cnyToUsd = parseFloat(<?php echo $data3; ?>);



  document.addEventListener('DOMContentLoaded', function() {
    const rates = {
      usd: {
        value: usdtToRub,
        symbol: '$'
      }, // Используем usdtToRub для USD
      eur: {
        value: euroToUsd * usdtToRub,
        symbol: '€'
      }, // Конвертируем EUR через USD
      cyn: {
        value: cnyToUsd * usdtToRub,
        symbol: '¥'
      } // Конвертируем CNY через USD
    };

    document.querySelector('.calculate__rate_usd span.rate-value').textContent = parseFloat(rates.usd.value.toFixed(2));
    document.querySelector('.calculate__rate_eur span.rate-value').textContent = parseFloat(rates.eur.value.toFixed(2));
    document.querySelector('.calculate__rate_cyn span.rate-value').textContent = parseFloat(rates.cyn.value.toFixed(2));

    const buyButton = document.getElementById('buyButton');
    const sellButton = document.getElementById('sellButton');
    const usdButton = document.getElementById('usdButton');
    const eurButton = document.getElementById('eurButton');
    const cynButton = document.getElementById('cynButton');
    const buyColumn = document.getElementById('buyColumn');
    const sellColumn = document.getElementById('sellColumn');
    const buyRange = document.getElementById('buyRange');
    const sellRange = document.getElementById('sellRange');
    const buyValue = document.getElementById('buyValue');
    const sellValue = document.getElementById('sellValue');
    const buySum = document.getElementById('buySum');
    const sellSum = document.getElementById('sellSum');
    const rateValues = document.querySelectorAll('.rate-value');

    let currentRate = rates.usd;
    let currentAction = 'buy';

    // Функция для обновления активной кнопки валюты
    function updateActiveCurrencyButton(currency) {
      // Убираем активный класс у всех кнопок валют
      usdButton.classList.remove('calculate__button_active');
      eurButton.classList.remove('calculate__button_active');
      cynButton.classList.remove('calculate__button_active');

      // Добавляем активный класс выбранной кнопке
      if (currency === 'usd') {
        usdButton.classList.add('calculate__button_active');
      } else if (currency === 'eur') {
        eurButton.classList.add('calculate__button_active');
      } else if (currency === 'cyn') {
        cynButton.classList.add('calculate__button_active');
      }
    }

    // Функция для обновления активной кнопки действия (купить/продать)
    function updateActiveActionButton(action) {
      // Убираем активный класс у обеих кнопок
      buyButton.classList.remove('calculate__button_active');
      sellButton.classList.remove('calculate__button_active');

      // Добавляем активный класс выбранной кнопке
      if (action === 'buy') {
        buyButton.classList.add('calculate__button_active');
      } else {
        sellButton.classList.add('calculate__button_active');
      }
    }

    // Функция для обновления курса
    function updateRate(rateKey) {
      currentRate = rates[rateKey];
      updateCalculation();
      updateActiveCurrencyButton(rateKey); // Обновляем активную кнопку валюты
    }

    // Функция для обновления действия (купить/продать)
    function updateAction(action) {
      currentAction = action;
      if (action === 'buy') {
        buyColumn.classList.add('calculate__column_active');
        sellColumn.classList.remove('calculate__column_active');
      } else {
        sellColumn.classList.add('calculate__column_active');
        buyColumn.classList.remove('calculate__column_active');
      }
      updateCalculation();
      updateActiveActionButton(action); // Обновляем активную кнопку действия
    }

    // Функция для обновления расчетов
    function updateCalculation() {
      const rangeValue = currentAction === 'buy' ? buyRange.value : sellRange.value;
      const sum = rangeValue * currentRate.value;

      let h_1 = sum / 100 * 1;
      let c2 = parseFloat((sum + h_1).toFixed(4));
      console.log(c2);

      // Обновляем значения с символами валют
      if (currentAction === 'buy') {

        buyValue.textContent = `${rangeValue} ${currentRate.symbol}`;
        buySum.textContent = `${parseFloat((c2 / 100 * 105).toFixed(2))} Р`;
      } else {
        sellValue.textContent = `${rangeValue} ${currentRate.symbol}`;
        sellSum.textContent = `${parseFloat((c2 / 100 * 102).toFixed(2))} Р`;
      }
    }

    // События для кнопок "Купить" и "Продать"
    buyButton.addEventListener('click', () => updateAction('buy'));
    sellButton.addEventListener('click', () => updateAction('sell'));

    // События для кнопок валют
    usdButton.addEventListener('click', () => updateRate('usd'));
    eurButton.addEventListener('click', () => updateRate('eur'));
    cynButton.addEventListener('click', () => updateRate('cyn'));

    // События для ползунков
    buyRange.addEventListener('input', updateCalculation);
    sellRange.addEventListener('input', updateCalculation);

    // Инициализация
    updateCalculation();
    updateActiveCurrencyButton('usd'); // Устанавливаем USD как активную валюту по умолчанию
    updateActiveActionButton('buy'); // Устанавливаем "Купить" как активное действие по умолчанию
  });
</script>
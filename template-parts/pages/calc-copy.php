<?php
$list = platejka_get_countries();
?>
<?php
$url1 = 'http://80.90.188.45/euro_to_usd.txt';
$url2 = 'http://80.90.188.45/usdt_to_rub.txt';
$url3 = 'http://80.90.188.45/cny_to_usd.txt';

$data1 = file_get_contents($url1);
$data2 = file_get_contents($url2);
$data3 = file_get_contents($url3);

?>
<section class="calc">
  <div class="container">
    <div class="calc__column">
      <div class="calc__title">Рассчитайте стоимость международного перевода</div>
      <div class="calc__row">
        <div class="calc__item">
          <div class="calc__valute">
            <div class="calc__top">Валюта платежа</div>
            <div class="calc__wrap">
              <button class="btn-reset calc__button calc__button_usd calc__button_active">Доллары</button>
              <button class="btn-reset calc__button calc__button_uer">Евро</button>
              <button class="btn-reset calc__button calc__button_cn">Юани</button>
            </div>
          </div>
          <div class="calc__input">
            <div class="calc__top">Страна отправителя</div>
            <div class="calc__input_select custom-select">
              <select name="countryFrom" id="countryFrom">
                <option value="Russia">Россия</option>
                <option value="Russia">Россия</option>
              </select>
            </div>
          </div>
          <div class="calc__input ">
            <div class="calc__top">Страна получателя</div>
            <div class="calc__input_select custom-select">
              <select name="country" id="countryTo" class="form-control">
                <?php foreach ($list as $row): ?>
                  <option value="<?php echo esc_attr( $row['iso'] ); ?>"><?php echo esc_html( $row['country_ru'] ); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="calc__input">
            <div class="calc__top">Сумма перевода</div>
            <div class="calc__input_input">
              <input type="number" id="amount" oninput="this.value=this.value.replace(/[^0-9]\./g,'');" placeholder="20 000">
              <span id="currency">USD</span>
            </div>
          </div>
        </div>
        <div class="calc__item calc__item_green">
          <div class="calc__head">Итого</div>
          <div class="calc__commission">
            <span>Комиссия платежного агента</span>
            <div id="commission" class="calc__commission-value">0,00 <span>₽</span></div>
          </div>
          <div class="calc__commission_main">
            <span>Основной платеж</span>
            <div id="totalWithCommission" class="calc__commission_main-value">0,00 <span>₽</span></div>
          </div>
          <div class="calc__wrapper">
            <div class="calc__transfer">
              <span>К переводу с комиссией</span>
              <div id="total" class="calc__transfer-value">0,00 <span>₽</span></div>
            </div>
            <button class="btn-reset calc__button_main">Начать перевод</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const buttons = {
      usd: document.querySelector('.calc__button_usd'),
      eur: document.querySelector('.calc__button_uer'),
      cny: document.querySelector('.calc__button_cn')
    };
    const amountInput = document.getElementById("amount");
    const commissionDisplay = document.getElementById("commission");
    const totalWithCommissionDisplay = document.getElementById("totalWithCommission");
    const totalDisplay = document.getElementById("total");
    const currencyDisplay = document.getElementById("currency");

    let selectedCurrency = 'USD'; // Default currency

    // Button Click Event Listeners
    buttons.usd.addEventListener('click', () => setCurrency('USD'));
    buttons.eur.addEventListener('click', () => setCurrency('EUR'));
    buttons.cny.addEventListener('click', () => setCurrency('CNY'));

    function setCurrency(currency) {
      selectedCurrency = currency;

      // Обновляем отображение валюты
      currencyDisplay.innerText = currency; // Изменяем текст в элементе currency

      // Сбрасываем все кнопки до неактивного состояния
      Object.values(buttons).forEach(btn => {
        if (btn) {
          btn.classList.remove('calc__button_active');
        }
      });

      // Устанавливаем выбранную кнопку в активное состояние
      if (buttons[currency.toLowerCase()]) {
        buttons[currency.toLowerCase()].classList.add('calc__button_active');
      }
      calculate();
    }
    amountInput.addEventListener('input', calculate);
    async function calculate() {
      const amount = parseFloat(amountInput.value);
      // Проверка: если amount пусто или равно нулю
      if (!amount || amount <= 0) {
        commissionDisplay.innerText = '0 ₽';
        totalWithCommissionDisplay.innerText = '0 ₽';
        totalDisplay.innerText = '0 ₽';
        return;
      }
      let results;
      switch (selectedCurrency) {
        case 'USD':
          if (amount === 0 || amount === null) {
            results = await calcUsdToRub(0)
          } else {
            results = await calcUsdToRub(amount);
          }
          break;
        case 'EUR':
          results = await calcEurToRub(amount);
          break;
        case 'CNY':
          results = await calcCnyToRub(amount);
          break;
      }
      displayResults(results);
    }
    document.querySelector('.calc__button_main').addEventListener('click', async () => {
      const amount = parseFloat(amountInput.value);
      if (!amount || isNaN(amount)) return;
      const button = document.querySelector('.calc__button_main');
      const countrySelect = document.getElementById('countryTo');
      const selectedCountryText = countrySelect.options[countrySelect.selectedIndex].text;

      button.textContent = 'Загрузка...'; // Изменение текста кнопки
      button.disabled = true; // Отключение кнопки

      let results;
      switch (selectedCurrency) {
        case 'USD':
          results = await calcUsdToRub(amount);
          break;
        case 'EUR':
          results = await calcEurToRub(amount);
          break;
        case 'CNY':
          results = await calcCnyToRub(amount);
          break;
      }
      displayResults(results);

      // Отправка данных в Telegram
      const message = `Выбранная валюта: ${selectedCurrency}\nВыбранная страна: ${selectedCountryText}\nСумма: ${amount} ${selectedCurrency}\nКомиссия платежного агента: ${results.com5X} ₽\nОсновной платеж: ${results.com95X.toFixed(2)} ₽\nК переводу с комиссией: ${results.finalAmount} ₽`;
      const encodedMessage = encodeURIComponent(message);
      // Перенаправление в Telegram через 3 секунды
      setTimeout(() => {
        // Здесь можно заменить URL на нужный вам
        window.open(`https://t.me/platejka_com?text=${encodedMessage}`, '_blank');
        button.textContent = 'Начать перевод'; // Изменение текста кнопки
        button.disabled = false; // Включение кнопки
      }, 1500);
    });

    function displayResults(results) {

      commissionDisplay.innerText = `${results.com5X} ₽`;
      totalWithCommissionDisplay.innerText = `${results.com95X.toFixed(2)} ₽`;
      totalDisplay.innerText = `${results.finalAmount} ₽`;
    }
  });

  async function calcEurToRub(x) {
    const com_5 = x / 100 * 5;
    const com = x + com_5;
    x += com_5;

    const c1 = parseFloat(<?php echo $data1 ?>);
    const usd = x * c1;
    x *= c1;

    const h = parseFloat(<?php echo $data2 ?>);
    const h_1 = h / 100 * 1;
    const c2 = parseFloat((h + h_1).toFixed(4));
    x *= c2;

    return {
      finalAmount: parseFloat(x.toFixed(2)),
      com5: parseFloat(com_5.toFixed(2)),
      com: parseFloat(com.toFixed(2)),
      c1: parseFloat(c1.toFixed(2)),
      usd: parseFloat(usd.toFixed(2)),
      h: parseFloat(h.toFixed(2)),
      h1: parseFloat(h_1.toFixed(2)),
      hTotal: parseFloat((h + h_1).toFixed(2)),
      com5X: parseFloat((com_5 * c1 * c2).toFixed(2)),
      com95X: parseFloat((x / 100 * 95).toFixed(2)),
    };
  }

  async function calcCnyToRub(x) {
    const com_5 = x / 100 * 5;
    const com = x + com_5;
    x += com_5;

    const c1 = parseFloat(<?php echo $data3 ?>);
    const usd = x * c1;
    x *= c1;

    const h = parseFloat(<?php echo $data2 ?>);
    const h_1 = h / 100 * 1;
    const c2 = parseFloat((h + h_1).toFixed(4));
    x *= c2;

    return {
      finalAmount: parseFloat(x.toFixed(2)),
      com5: parseFloat(com_5.toFixed(2)),
      com: parseFloat(com.toFixed(2)),
      c1: parseFloat(c1.toFixed(2)),
      usd: parseFloat(usd.toFixed(2)),
      h: parseFloat(h.toFixed(2)),
      h1: parseFloat(h_1.toFixed(2)),
      hTotal: parseFloat((h + h_1).toFixed(2)),
      com5X: parseFloat((com_5 * c1 * c2).toFixed(2)),
      com95X: parseFloat((x / 100 * 95).toFixed(2)),
    };
  }

  async function calcUsdToRub(x) {
    const com_5 = x / 100 * 5;
    const com = x + com_5;
    x += com_5;

    const h = parseFloat(<?php echo $data2 ?>);
    const h_1 = h / 100 * 1;
    const c2 = parseFloat((h + h_1).toFixed(4));
    x *= c2;

    return {
      finalAmount: parseFloat(x.toFixed(2)),
      com5: parseFloat(com_5.toFixed(2)),
      com: parseFloat(com.toFixed(2)),
      h: parseFloat(h.toFixed(2)),
      h1: parseFloat(h_1.toFixed(2)),
      hTotal: parseFloat((h + h_1).toFixed(2)),
      com5X: parseFloat((com_5 * c2).toFixed(2)),
      com95X: parseFloat((x / 100 * 95).toFixed(2)),
    };
  }
</script>
<script>
  var x, i, j, l, ll, selElmnt, a, b, c;
  /*look for any elements with the class "custom-select":*/
  x = document.getElementsByClassName("custom-select");
  l = x.length;
  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
      /*for each option in the original select element,
      create a new DIV that will act as an option item:*/
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
      });
      b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }

  function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  /*if the user clicks anywhere outside the select box,
  then close all select boxes:*/
  document.addEventListener("click", closeAllSelect);
</script>

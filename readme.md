# zadanie 1

### Instrukcja uruchomienia:
1. W bieżącym katalogu uruchom ```docker compose up -d``` aby zbudować i uruchomić kontenery.
2. Wykonaj migracje zawarte w pliku postgres/init.sql jeśli nie wykonały się automatycznie
```
Utwórz tabele przechowujące dane klientów, faktury, pozycje faktur, płatności oraz nadpłaty.

Tabele powinny przechowywać następujące dane:

klienci: nazwa przedsiębiorcy, numer konta bankowego, NIP,
faktury: numer, data wystawienia, termin płatności, suma brutto,
pozycje faktury: nazwa produktu, ilość, cena,
płatności: tytuł płatności, kwota, data wpłaty, numer konta bankowego wpłaty.
Tabele powinny być wypełnione przykładowymi danymi tak, aby można było zobrazować poniższe założenia.

Prosimy o napisanie kodu realizującego następujące zadania:

raport wyświetlający nadpłaty na koncie klienta,
raport wyświetlający niedopłaty za faktury,
raport wyświetlający nierozliczone faktury po terminie płatności.
Raporty powinny mieć możliwość sortowanie oraz filtrowania wyświetlanych danych.

Przesłany kod powinien być napisany bez wykorzystania frameworków oraz systemów szablonów.
Uwaga: zadania powinny być napisane obiektowo z wykorzystaniem najnowszych rozwiązań w języku PHP 8 z wykorzystaniem standardu min. PSR-7.
```

# zadanie 2
### wersja po refaktorze znajduje się w refactor/after
```
Przeprowadź refaktoryzację poniższego kodu.

// contracts

// 0 => id, 2 => nazwa przedsiebiorcy, 4 => NIP, 10 => kwota,

if ($_GET['akcja'] == 5) {

    // show contracts with amount more than 10

    $x = "id = {$_GET[i]} AND kwota > 10; ";

    switch ($_GET['sort'])

    {

    case 1: $sql_orderby = " order by 2, 4"; break;

    case 2: $sql_orderby = " order by 10"; break;

    }

    if ($sql_orderby == ' order by 2, 4') $b = 'DESC';

    $i = "SELECT * FROM contracts WHERE $x ORDER BY $sql_orderby $b";

    $a = mysql_query($i);

    echo "<html><body bgcolor=$dg_bgcolor>";

    echo "<br>";

    echo "<table width=95%>";

    while ($z = mysql_fetch_array($a)) {

            echo '<tr>';

        echo '<td>'.$z[0];

        echo '</td>';

        echo '<td>';

        echo $z[2];

        if ($z[10] > 5)

        { echo ' '; echo $z[10];

        } echo '</td><tr>';

    }

} else {

    $c = mysql_query("SELECT * FROM contracts WHERE $x ORDER BY id");

    echo "<html><body bgcolor=$dg_bgcolor>";

    echo "<br>";

    echo "<table width=95%>";

    while ($z = mysql_fetch_array($c)) {

        echo '<tr><td>'.$z[0];

        echo '</td>';

        echo '<td>';

        echo $z[2];

        echo '</td><tr>';

    }

}

echo '</table></body></html>';
```

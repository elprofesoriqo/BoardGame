<?php

class Plansza
{
    private $x;
    private $y;
    private $plansza;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->plansza = $this->generujPlansze();
    }

    private function generujPlansze()
    {
        $plansza = [];

        // Tworzenie planszy
        for ($i = 0; $i < $this->y; $i++) {
            $wiersz = [];
            for ($j = 0; $j < $this->x; $j++) {
                $pole = [
                    'teren' => rand(1, 5),
                    'energia' => 0,
                    'oswietlenie' => 0
                ];
                $wiersz[] = $pole;
            }
            $plansza[] = $wiersz;
        }

        // Przypisanie oświetlenia
        $iloscOswietlen = intval(($this->x * $this->y) / 30);
        for ($i = 0; $i < $iloscOswietlen; $i++) {
            $losoweX = rand(0, $this->x - 1);
            $losoweY = rand(0, $this->y - 1);
            $this->przypiszOswietlenie($plansza, $losoweX, $losoweY, 10);
        }

        // Przypisanie energii
        $iloscEnergii = intval(($this->x * $this->y) / 13);
        for ($i = 0; $i < $iloscEnergii; $i++) {
            $losoweX = rand(0, $this->x - 1);
            $losoweY = rand(0, $this->y - 1);
            $energia = rand(5, 8);
            $plansza[$losoweY][$losoweX]['energia'] = $energia;
        }

        return $plansza;
    }

    private function przypiszOswietlenie(&$plansza, $x, $y, $wartosc)
    {
        if ($x >= 0 && $x < $this->x && $y >= 0 && $y < $this->y && $plansza[$y][$x]['oswietlenie'] < $wartosc) {
            $plansza[$y][$x]['oswietlenie'] = $wartosc;
            $this->przypiszOswietlenie($plansza, $x + 1, $y, $wartosc - 1);
            $this->przypiszOswietlenie($plansza, $x - 1, $y, $wartosc - 1);
            $this->przypiszOswietlenie($plansza, $x, $y + 1, $wartosc - 1);
            $this->przypiszOswietlenie($plansza, $x, $y - 1, $wartosc - 1);
        }
    }

    // public function wyswietlPlansze()
    // {
    //     echo "<table>";
    //     foreach ($this->plansza as $wiersz) {
    //         echo "<tr>";
    //         foreach ($wiersz as $pole) {
    //             $teren = $pole['teren'];
    //             $energia = $pole['energia'];
    //             $oswietlenie = $pole['oswietlenie'];
    //             $kolor = sprintf("#%06x", rand(0, 0xFFFFFF));

    //             echo "<td style='background-color: $kolor'>";
    //             echo "Teren: $teren<br>";
    //             echo "Energia: $energia<br>";
    //             echo "Oświetlenie: $oswietlenie";
    //             echo "</td>";
    //         }
    //         echo "</tr>";
    //     }
    //     echo "</table>";
    // }

    private function generujPodsumowanie()
    {
        $podsumowanie = [];
        for ($i = 10; $i >= 0; $i--) {
            $podsumowanie[$i] = [
                'iloscPol' => 0,
                'iloscOswietlenia' => 0,
                'iloscEnergii' => 0,
                'iloscTerenu' => 0
            ];
        }
    
        foreach ($this->plansza as $wiersz) {
            foreach ($wiersz as $pole) {
                $iloscOswietlenia = $pole['oswietlenie'];
                $energia = $pole['energia'];
                $teren = $pole['teren'];
    
                $podsumowanie[$iloscOswietlenia]['iloscOswietlenia'] += ($iloscOswietlenia > 0) ? 1 : 0;
                $podsumowanie[$energia]['iloscEnergii'] += ($energia >= 0 && $energia <= 8) ? 1 : 0;

                $podsumowanie[$teren]['iloscTerenu'] += ($teren <= 5) ? 1 : 0;
            }
        }
    
        return $podsumowanie;
    }
    
    

    
    public function wyswietlPlansze()
    {
        echo "<table>";
        foreach ($this->plansza as $wiersz) {
            echo "<tr>";
            foreach ($wiersz as $pole) {
                $teren = $pole['teren'];
                $energia = $pole['energia'];
                $oswietlenie = $pole['oswietlenie'];
                $kolor = sprintf("#%06x", rand(0, 0xFFFFFF));
    
                echo "<td style='background-color: $kolor; padding: 20px' >";
                echo "Teren: $teren<br>";
                echo "Energia: $energia<br>";
                echo "Oświetlenie: $oswietlenie";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
        // Podsumowanie
        $podsumowanie = $this->generujPodsumowanie();
        echo "<h1>Podsumowanie ilości pól z daną wartością atrybutu</h1>";
        echo "<table>";
        echo "<tr><th>Wartość</th><th>Ilość oświetlenia</th><th>Ilość energii</th><th>Ilość terenu</th></tr>";
        foreach ($podsumowanie as $wartosc => $statystyki) {
            echo "<tr>";
            echo "<td>$wartosc</td>";
            echo "<td>{$statystyki['iloscOswietlenia']}</td>";
            echo "<td>{$statystyki['iloscEnergii']}</td>";
            echo "<td>{$statystyki['iloscTerenu']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    

}

// Sprawdzanie czy dane zostały przesłane przez formularz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobieranie wartości x i y z formularza
    $x = intval($_POST['x']);
    $y = intval($_POST['y']);

    // Sprawdzanie czy wartości x i y zawierają się w przedziale od 10 do 50
    if ($x >= 10 && $x <= 50 && $y >= 10 && $y <= 50) {
        $plansza = new Plansza($x, $y);
        $plansza->wyswietlPlansze();
    } else {
        echo "Podane wartości x i y muszą zawierać się w przedziale od 10 do 50.";
    }
}
?>
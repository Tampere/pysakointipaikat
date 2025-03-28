# Pysäköintipaikat

Tämä sovellus näyttää Tampereen pysäköintipaikat saavutettavassa HTML-taulukossa. 
Tiedot haetaan Tampereen kaupungin avoimesta rajapinnasta, suodattaen ja yhdistäen samankaltaiset rivit.
Toistaiseksi käyttää vuoden 2019 tietoja.

## Ominaisuudet

- **Dynaaminen data**: Tiedot haetaan suoraan Tampereen kaupungin [geoserver-rajapinnasta](https://geodata.tampere.fi/geoserver/).
- **Saavutettava taulukko**: HTML-taulukko on suunniteltu saavutettavaksi ruudunlukijoille.
- **Tietojen yhdistäminen**: Samankaltaiset rivit yhdistetään laskemalla paikkamäärät yhteen.
- **Lajittelu**: Taulukko lajitellaan osoitteen mukaan aakkosjärjestykseen.


## Riippuvuudet

- PHP 7.4 tai uudempi
- Internet-yhteys

## Esimerkki

Taulukko näyttää tiedot seuraavassa muodossa:

| Osoite  | Alueen tyyppi | Paikkoja | Pysäköintirajoitus | Maksuvyöhyke | Pisin sallittu aika | Lisätietoa |
|---------|---------------|----------|--------------------|-------------|---------------------|------------|
| Amuri   | pysäköintialue | 10       | kiekkopysäköinti   | -           | 4                  | -          |

## Lisätietoja

Lisätietoja Tampereen kaupungin pysäköintipaikoista löytyy [GitHub-repositorion](https://github.com/Tampere/pysakointipaikat) kautta.

## Lisenssi

Tämä projekti käyttää avointa dataa Tampereen kaupungilta. Tarkista datan käyttöehdot [täältä](https://www.tampere.fi/avoindata).

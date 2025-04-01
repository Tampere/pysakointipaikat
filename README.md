# Pysäköintipaikat

Tämä sovellus näyttää Tampereen pysäköintipaikat saavutettavassa HTML-taulukossa. 
Tiedot haetaan Tampereen kaupungin avoimesta rajapinnasta, suodattaen ja yhdistäen samankaltaiset rivit.

## Ominaisuudet

- **Saavutettava taulukko**: HTML-taulukko on suunniteltu saavutettavaksi ruudunlukijoille.
- **Dynaaminen data**: Tiedot haetaan suoraan Tampereen kaupungin [geoserver-rajapinnasta](https://geodata.tampere.fi/geoserver/).
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

https://data.tampere.fi/data/fi/dataset/tampereen-keskustan-maksulliset-pysakointialueet

## Lisenssi

Sovellus käyttää avointa dataa. 

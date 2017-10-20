nlsh_zitate-bundle
==================

Sammeln und Verwaltung von Zitaten
--------------------------------------

Dies ist eine Contao 4 Bundle.

Es dient nur der Verwaltung von Zitaten im Backend. 
Im Front- End existiert eigentlich kein richtiges Template, zu mindestens kein vollständiges, professionelles „Design“- tes.

Dies könnte mal später entstehen, bzw. euer Fantasie sind keine Grenzen gesetzt. Über Rückmeldungen wäre ich schon froh, wenn Template- Variablen fehlen, scheut euch nicht, diese einzufordern.
Alles ist nur ein Geben und Nehmen.

Entstanden ist dieses Bundle nur, da es so viele Aussagen und persönlichen Meinungen (Statements) verschiedener Menschen, zu bestimmten Ereignissen und Prozessen in unserer Geschichte gibt, dass man schnell viele wieder gleich vergisst, obwohl Sie eigentlich in unsrem Leben innerlich weiterschwingen und uns beeinflussen. 

Ok, zum technischen.

Im Template stehen z.Z. 3 Variablen zur Verfügung.

**1. `$this->arrError`**

```php
/**
 * Fehlermeldungen
 *
 * @var null|array null, wenn keine Fehlermeldungen vorhanden
 *                 |
 *                 ein Array mit den einzelnen Fehlermeldungen
 */
z.B.
$this->arrError => array:3 [
                    0 => "Keine Sammlung ausgewählt!"
                    1 => "Keine Zitate vorhanden!"
                    2 => "..."
                   ]
```

**2.`$this->arrZitateIndexCollectionName`**

```php
/**
 * Ausgewählte Zitate, indiziert mit dem Namen der Zitatensammlung
 *
 * @var null|array null, wenn keine Zitate in ausgewählte Sammlungen enthalten
 *                 |
 *                 ein Array mit den ausgewählten Zitaten,
 *                 jeweils indiziert mit dem 'Namen' der Sammlung
 */
$this->arrZitateIndexCollectionName => array:2 [
        Songtexte => array:2 [
                        0 => array:12 [
                                "id"         => "1"
                                "pid"        => "2"
                                "sorting"    => "128"
                                "tstamp"     => "1507748604"
                                "published"  => "1"
                                "zitat"      => "<p>Ich weiß, dass die Frau die mich erträgt noch nicht geboren ist, ▶"
                                "teaser"     => "Ich weiß, daß die Frau die mich erträgt noch nicht geboren ist..."
                                "source"     => "Falco Song 'Emotional'"
                                "zitateUrl"  => "'http://www.falco.at/?page_id=353'"
                                "autor"      => "Falco"
                                "autorUrl"   => "'http://www.falco.at/'"
                                "categories" => ""
                             ]
                        1 => array:12 [
                               "id"          => "2"
                                "pid"        => "2"
                                ...
                             ]
                     ]
        Sprüche   => array:1 [
                        0 => array:12 [
                                "id"         => "3"
                                "pid"        => "3"
                                ...
                             ]
                     ]
]
```

**3.`$this->arrZitate`**

```php
/**
 * Ausgewählte Zitate
 *
 * @var null|array null, wenn keine Zitate vorhanden
 *                 |
 *                 ein Array mit allen auszugebenen Zitaten, ohne Indizierung,
 *                 ein Key ['collectionName'] mit dem 'Namen' der Sammlung wird hinzugefügt
 */
$this->arrZitate => array:3 [
                      0 => array:13 [
                              "id"             => "1"
                              "pid"            => "2"
                              ...
                              "collectionName" => "Songtexte"
                           ]
                      1 => array:13 [
                              "id"             => "2"
                              "pid"            => "2"
                              ...
                              "collectionName" => "Songtexte"
                           ]
                      2 => array:13 [
                              "id" => "3"
                              "pid" => "3"
                              ...
                              "collectionName" => "Sprüche"
                           ]
                    ]
```




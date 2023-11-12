# ADP

- Fixed Array in php documentation: https://www.php.net/manual/en/class.splfixedarray.php

---

## Performance of the algorithms

`0(1)` - constant time (item 1 and 555 take the same time)
`0(n)` - linear time (item 1 takes 1 second, item 555 takes 555 seconds)


## Algorithms performance

### Dynamic Array
**Dataset**: `10.000` items in de array

**Mogelijke verbetering**:
Geen verbetering mogelijk

#### Insertion
**Time**: `0.68 sec.`

**Analyse**:
De insertion in een dynamic array is meestal snel (`0(1)`), behalve wanneer de array zijn capaciteit bereikt. Op dat moment moet de array vergroot worden (in dit geval `n*2 + 1`), wat een `0(n)` operatie is omdat alle elementen naar de nieuwe array gekopieerd moeten worden.

#### Retrieval
**Time**: `0.32 sec.`

**Analyse**:
Het ophalen van een element op een specifieke index in een dynamic array is een `0(1)` operatie, omdat het direct toegang heeft tot het element via de index.

#### Deletion
**Time start to end**: `0.58 sec.`

**Time end to start**: `0.36 sec.`

**Analyse**:
Het verwijderen van een element kan variëren in snelheid. Als het laatste element wordt verwijderd, is het `0(1)`. Echter, als een element van ergens anders in de array wordt verwijderd, is het `0(n)` vanwege de noodzaak om elementen te verschuiven om de lege ruimte op te vullen.


---

### Doubly Linked List
**Dataset**: `10.000` items in de array

**Mogelijke verbetering**:
Een (gedeeltelijke) dictionary implementatie zou de retrieval tijd kunnen verbeteren. Dit zou de retrieval tijd van `0(n)` naar `0(1)` kunnen brengen.

#### Insertion
**Time**: `0.010 sec.`

**Analyse**:
Het invoegen in een doubly linked list is 0(1) omdat het alleen de pointers van de betrokken nodes hoeft aan te passen.

#### Retrieval
**Time**: `1.87 sec.`

Bij een doubly link list is het ophalen van een element een `0(n)` operatie. Dit komt omdat het niet direct naar het element kan springen. Het moet eerst door de lijst itereren om het element te vinden.

#### Deletion
**Time start to end**: `0.025 sec.`

**Time end to start**: `0.027 sec.`

**Analyse**:
Het verwijderen van een element is een `0(1)` operatie. Dit komt omdat het enkel de pointers moet aanpassen van de vorige en volgende node.

---

### Stack
**Dataset**: `1.000.000` items in de array

**Mogelijke verbetering**:
Geen directe verbetering mogelijk

#### Insertion
**Time**: `0.98 sec.`

**Analyse**:
Stacks voegen elementen toe aan de top en dit is een `0(1)` operatie.

#### Retrieval
**Time**: `0.78 sec.`

**Analyse**:
Stacks staan alleen toegang toe tot het bovenste element (Last In, First Out - LIFO). Het bekijken van het bovenste element is `0(1)`, maar het zoeken naar een element in de stack is niet typisch en zou `0(n)` zijn.

#### Deletion
**Time**: `0.80 sec.`

**Analyse**:
Het verwijderen van het bovenste element in een stack is ook een `0(1)` operatie.

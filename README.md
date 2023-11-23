# ADP

## Execute the unit tests
It's very simple to execute the unit tests. Just follow the stepts below.
1. Open the codespace: https://github.com/codespaces/new/RoyvanEmpel/ADP
2. execute `/bin/bash ./unit-tests.sh` inside the terminal in the codespace.
3. Voilá, the unit tests for all cases have runned.

## Good to know about
- Fixed Array in php documentation: https://www.php.net/manual/en/class.splfixedarray.php

---

## Performance of the datastructures

`O(1)` - constant time (item 1 and 555 take the same time)
`O(N)` - linear time (item 1 takes 1 second, item 555 takes 555 seconds)


## Datastructures performance

### Dynamic Array
**Dataset**: `50.000` items in de array

**Mogelijke verbetering**:
Geen verbetering mogelijk

#### Insertion
- **Time**: `0.0344 sec.`

**Analyse**:
De insertion in een dynamic array is meestal snel (`O(1)`), behalve wanneer de array zijn capaciteit bereikt. Op dat moment moet de array vergroot worden (in dit geval `n*2 + 1`), wat een `O(N)` operatie is omdat alle elementen naar de nieuwe array gekopieerd moeten worden.

#### Retrieval
- **Time (index)**: `0.006 sec.`
- **Time (waarde)**: `50.878 sec.`
- **Time (contains waarde)**: `52.165 sec.`

**Analyse**:
Het ophalen van een element op een specifieke index in een dynamic array is een `O(1)` operatie, omdat het direct toegang heeft tot het element via de index.

#### Deletion
- **Time start to end**: `0.012 sec.`
- **Time end to start**: `0.007 sec.`

**Analyse**:
Het verwijderen van een element kan variëren in snelheid. Als het laatste element wordt verwijderd, is het `O(1)`. Echter, als een element van ergens anders in de array wordt verwijderd, is het `O(N)` vanwege de noodzaak om elementen te verschuiven om de lege ruimte op te vullen.


---

### Doubly Linked List
**Dataset**: `50.000` items in de array

**Mogelijke verbetering**:
Een (gedeeltelijke) dictionary implementatie zou de retrieval tijd kunnen verbeteren. Dit zou de retrieval tijd van `O(N)` naar `O(1)` kunnen brengen.

#### Insertion
- **Time**: `0.031 sec.`

**Analyse**:
Het invoegen in een doubly linked list is `O(1)` omdat het alleen de pointers van de betrokken nodes hoeft aan te passen.

#### Retrieval
- **Time**: `54.002 sec.`

Bij een doubly link list is het ophalen van een element een `O(N)` operatie. Dit komt omdat het niet direct naar het element kan springen. Het moet eerst door de lijst itereren om het element te vinden.

#### Deletion
- **Time ->pop()**: `0.017 sec.`
- **Time ->shift()**: `0.015 sec.`
- **Time start to end**: `0.025 sec.`
- **Time end to start**: `55.148 sec.`

**Analyse**:
Het verwijderen van een element is een `O(1)` operatie. Dit komt omdat het enkel de pointers moet aanpassen van de vorige en volgende node.

---

### Stack
**Dataset**: `50.000` items in de array

**Mogelijke verbetering**:
Geen directe verbetering mogelijk

#### Insertion
- **Time**: `0.035 sec.`

**Analyse**:
Stacks voegen elementen toe aan de top en dit is een `O(1)` operatie.

#### Retrieval
- **Time**: `0.019 sec.`

**Analyse**:
Stacks staan alleen toegang toe tot het bovenste element (Last In, First Out - LIFO). Het bekijken van het bovenste element is `O(1)`, maar het zoeken naar een element in de stack is niet typisch en zou `O(N)` zijn.

#### Deletion
- **Time**: `0.021 sec.`

**Analyse**:
Het verwijderen van het bovenste element in een stack is ook een `O(1)` operatie.

---

### Priority Queue
**Dataset**: `50.000` items in de array

#### Insertion
- **Time linear**: `295.405 sec.`
- **Time random**: `235.661 sec.`

**Analyse**:
Het toevoegen van een element aan een priority queue is een `O(N)` operatie. Dit komt omdat het de elementen moet sorteren op basis van de prioriteit.

#### Retrieval
- **Time**: `0.026 sec.`

**Analyse**:
Het ophalen van het hoogste element in een priority queue is een `O(1)` operatie.

#### Deletion
- **Time**: `0.050 sec.`

**Analyse**:
Het verwijderen van het hoogste element in een priority queue is een `O(1)` operatie.

---

### Deque
**Dataset**: `50.000` items in de array

#### Insertion
- **Time (insertLeft)**: `0.034 sec.`
- **Time (insertRight)**: `0.040 sec.`

**Analyse**:
Het toevoegen van een element aan een deque is een `O(1)` operatie. Dit komt omdat het enkel de pointers van de betrokken nodes hoeft aan te passen.

#### Deletion
- **Time (deleteLeft)**: `0.020 sec.`
- **Time (deleteRight)**: `0.020 sec.`

**Analyse**:
Het verwijderen van een element is een `O(1)` operatie. Dit komt omdat het enkel de pointers moet aanpassen van de vorige en volgende node.cc

---

### Binary Search
**Dataset**: `50.000` items in de array

#### Search time
- **Time**: `0.218 sec.`

**Analyse**:
Binary search is een `O(log N)` operatie. Dit komt omdat het de dataset in tweeën splitst en vervolgens de helft van de dataset negeert. Het blijft dit doen totdat het het element vindt dat het zoekt.

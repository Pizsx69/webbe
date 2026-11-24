# Gyakorló feladatok – mind

1. Futtasd le az első (beküldő) cellát (Shift + Enter). Kiírja, hogy gyakorló vagy ZH módban van-e a szerver.
2. **ZH-n**: írd be a **Neptun-kódodat** a `NEPTUN` sorba; az első beküldésnél a program kéri az **egyéni kulcsodat** (az oktatótól kaptad). Gyakorláskor ez nem kell.
3. Minden feladatnál írd meg a függvényt, majd futtasd a cellát: a kód a javítószerverre megy, és azonnal látod az eredményt és a pontszámot.
4. Többször is beküldheted; a szerver minden beküldést rögzít.
5. A `%%submit` sort ne módosítsd.
# ================================================================
#  BEKÜLDŐ CELLA – futtasd le ELSŐKÉNT, és ne módosítsd!
#  Gyakorláskor a NEPTUN maradhat üresen.
#  ZH-n írd be a Neptun-kódodat; a kulcsot az első beküldéskor kéri
#  a program (nem kerül bele a notebookba).
# ================================================================
NEPTUN = ""          # ZH-n kötelező, pl. "ABC123"

SERVER_URL = "https://gpt.nettuts.hu/api/v2/submit"

import getpass, html, json
import requests
from IPython.core.magic import register_cell_magic
from IPython.display import HTML, display

_KULCS = None


def _kulcs():
    global _KULCS
    if not _KULCS:
        _KULCS = getpass.getpass("Egyéni kulcs (az oktatótól, pl. ABCDE-12345): ").strip()
    return _KULCS


def _megjelenit(d):
    e = html.escape
    if not d.get("cases"):
        display(HTML(f'<div style="padding:10px;border-left:4px solid #c0392b;background:#fdecea;color:#5c1a14">'
                     f'❌ {e(d.get("message") or "Ismeretlen hiba")}</div>'))
        return
    ok = d["status"] == "passed"
    szin, hatter = ("#1e7e34", "#e6f4ea") if ok else ("#b35900", "#fff4e5")
    sorok = []
    for c in d["cases"]:
        reszlet = ""
        if c.get("call"):
            reszlet += f'<code>{e(c["call"])}</code>'
        if not c["ok"]:
            if "got" in c:
                reszlet += f'<br>kapott: <code>{e(c["got"])}</code>'
            if "expected" in c:
                reszlet += f'<br>várt: <code>{e(c["expected"])}</code>'
            if c.get("message") and c.get("message") != "hibás eredmény":
                reszlet += f'<br><span style="color:#a33">{e(c["message"])}</span>'
            if c.get("traceback"):
                reszlet += f'<pre style="margin:4px 0;font-size:12px">{e(c["traceback"])}</pre>'
        sorok.append(f'<tr><td style="padding:2px 8px">{"✅" if c["ok"] else "❌"}</td>'
                     f'<td style="padding:2px 8px">{e(c["name"])}</td><td style="padding:2px 8px">{reszlet}</td></tr>')
    hiba = ""
    if d.get("error"):
        er = d["error"]
        hiba = (f'<div style="margin:6px 0;color:#a33"><b>{e(str(er.get("type")))}</b>: {e(str(er.get("msg")))}'
                + (f'<pre style="font-size:12px">{e(er["tb"])}</pre>' if er.get("tb") else "") + "</div>")
    display(HTML(
        f'<div style="padding:10px;border-left:4px solid {szin};background:{hatter};color:#222">'
        f'<b>{"✅ Minden teszt sikeres" if ok else "⚠️ Nem minden teszt sikeres"}</b> – '
        f'{d["task"]}: <b>{d["score"]:g} / {d["max_score"]:g} pont</b> ({d["passed"]}/{d["total"]} eset)'
        f'{hiba}<table style="margin-top:6px;border-collapse:collapse">{"".join(sorok)}</table>'
        f'<div style="font-size:11px;color:#666;margin-top:4px">beküldés: {e(d.get("submission_id", ""))}</div></div>'))


@register_cell_magic
def submit(line, cell):
    feladat = line.strip()
    adat = {"task": feladat, "code": cell}
    if NEPTUN.strip():
        adat.update(neptun=NEPTUN.strip(), token=_kulcs())
    print(f"📡 Beküldés: {feladat} …")
    try:
        r = requests.post(SERVER_URL, json=adat, timeout=40)
        d = r.json()
    except Exception as ex:  # noqa: BLE001
        print(f"Hiba a kommunikációban: {ex}")
        return
    if r.status_code == 401:
        global _KULCS
        _KULCS = None  # legközelebb újra kérjük
    _megjelenit(d)
    # A függvényt itt is létrehozzuk, hogy a notebookban kipróbálhasd:
    try:
        exec(cell, globals())
    except BaseException as ex:  # noqa: BLE001
        print(f"(helyi futtatás: {type(ex).__name__}: {ex})")


try:
    _info = requests.get(SERVER_URL.rsplit("/", 1)[0] + "/info", timeout=10).json()
except Exception:  # noqa: BLE001
    _info = {}
if _info.get("mode") == "exam":
    print("Beküldő betöltve. ✔  🎓 ZH mód:", f"Neptun-kód: {NEPTUN}" if NEPTUN.strip()
          else "⚠️ írd be a Neptun-kódodat a NEPTUN sorba, és futtasd újra ezt a cellát!")
elif _info.get("mode") == "practice":
    print("Beküldő betöltve. ✔  🧪 Gyakorló mód – Neptun-kód és kulcs nem szükséges.")
else:
    print("Beküldő betöltve. ✔  (a szerver most nem érhető el)")

%%submit task01-print-variables

"""
Feladat: Változók kiírása
Leírás: Készíts egy függvényt, amely két változó értékét egy szövegbe foglalja, és ezt a
        szöveget visszaadja (nem kiírja).
Függvény neve: print_variables
Paraméterek: a, b (számok)
Visszatérési érték: a és b értékeket tartalmazó szöveges üzenet
Példa: print_variables(5, 10) → 'Variable a: 5, Variable b: 10'  (a függvény adja vissza, ne
       kiírja)
Nehézség: ★☆☆ könnyű
"""

def print_variables(a, b):
    # Írd meg a megoldást itt
    return f"Variable a: {a}, Variable b: {b}";

%%submit task02-string-slice

"""
Feladat: Szöveg kivágása
Leírás: Készíts egy függvényt, amely kinyeri a szöveg egy adott részét.
Függvény neve: string_slice
Paraméterek: text (szöveg), start (kezdő index), end (vég index)
Visszatérési érték: a kiválasztott rész
Példa: string_slice('Hello World', 6, 11) → 'World'
Nehézség: ★☆☆ könnyű
"""

def string_slice(text, start, end):
    # Írd meg a megoldást itt
    return text[start:end]

%%submit task03-list-slice

"""
Feladat: Lista kivágása
Leírás: Készíts egy függvényt, amely kinyeri a lista egy adott részét.
Függvény neve: list_slice
Paraméterek: lst (lista), start (kezdő index), end (vég index)
Visszatérési érték: a kiválasztott rész
Példa: list_slice([1, 2, 3, 4, 5], 1, 4) → [2, 3, 4]
Nehézség: ★☆☆ könnyű
"""

def list_slice(lst, start, end):
    # Írd meg a megoldást itt
    return lst[start:end]

%%submit task04-remove-duplicates

"""
Feladat: Duplikátumok eltávolítása
Leírás: Készíts egy függvényt, amely eltávolítja a lista duplikátumait.
Függvény neve: remove_duplicates
Paraméterek: lst (lista)
Visszatérési érték: lista duplikátumok nélkül
Példa: remove_duplicates([1, 2, 2, 3]) → [1, 2, 3]  (az első előfordulások sorrendjében)
Nehézség: ★☆☆ könnyű
"""

def remove_duplicates(lst):
    # Írd meg a megoldást itt
    unique_lst = []
    for item in lst:
        if item not in unique_lst:
            unique_lst.append(item)
    return unique_lst

%%submit task05-list-comprehension

"""
Feladat: Páros számok listája
Leírás: Készíts egy függvényt, amely lista komprehencióval generálja a páros számokat.
Függvény neve: list_comprehension
Paraméterek: n (egész szám)
Visszatérési érték: n-nél kisebb páros számok listája
Példa: list_comprehension(5) → [0, 2, 4]
Nehézség: ★☆☆ könnyű
"""

def list_comprehension(n):
    # Írd meg a megoldást itt
    return [i for i in range(n) if i%2==0]
%%submit task06-substring-find

"""
Feladat: Részszöveg keresése
Leírás: Készíts egy függvényt, amely meghatározza, hogy egy szöveg tartalmaz-e egy másik
        szöveget.
Függvény neve: substring_find
Paraméterek: text (szöveg), substring (részszöveg)
Visszatérési érték: boolean érték (True, ha benne van, különben False)
Példa: substring_find('Hello World', 'World') → True
Nehézség: ★☆☆ könnyű
"""

def substring_find(text, substring):
    # Írd meg a megoldást itt
    return substring in text

%%submit task07-conditional-statements

"""
Feladat: Páros vagy páratlan
Leírás: Készíts egy függvényt, amely eldönti, hogy egy szám páros-e vagy nem.
Függvény neve: conditional_statements
Paraméterek: n (egész szám)
Visszatérési érték: "even" vagy "odd"
Példa: conditional_statements(7) → 'odd',  conditional_statements(4) → 'even'
Nehézség: ★☆☆ könnyű
"""

def conditional_statements(n):
    return "even" if n%2==0 else "odd"
%%submit task08-looping-through-lists

"""
Feladat: Lista elemeinek összege
Leírás: Készíts egy függvényt, amely átjárja a lista elemeit és összeadja azokat.
Függvény neve: looping_through_lists
Paraméterek: lst (lista)
Visszatérési érték: az elemek összege
Példa: looping_through_lists([1, 2, 3]) → 6
Nehézség: ★☆☆ könnyű
"""

def looping_through_lists(lst):
    return sum(lst)
%%submit task09-functions

"""
Feladat: Két szám szorzata
Leírás: Készíts egy függvényt, amely két számot összeszoroz.
Függvény neve: functions
Paraméterek: a, b (számok)
Visszatérési érték: a és b szorzata
Példa: functions(3, 4) → 12  (a két szám szorzata)
Nehézség: ★☆☆ könnyű
"""

def functions(a, b):
    return a*b
%%submit task10-string-replace

"""
Feladat: Szövegcsere
Leírás: Készíts egy függvényt, amely cserél egy szövegrészletet másikra.
Függvény neve: string_replace
Paraméterek: text (szöveg), old (régi szöveg), new (új szöveg)
Visszatérési érték: a módosított szöveg
Példa: string_replace('Hello World', 'World', 'Universe') → 'Hello Universe'
Nehézség: ★☆☆ könnyű
"""

def string_replace(text, old, new):
    return text.replace(old,new)
%%submit task11-dict-access

"""
Feladat: Szótár elérése
Leírás: Készíts egy függvényt, amely elér egy szótár értékét kulcs alapján.
Függvény neve: dict_access
Paraméterek: d (szótár), key (kulcs)
Visszatérési érték: a kulcshoz tartozó érték
Példa: dict_access({'a': 1}, 'a') → 1;  hiányzó kulcsnál KeyError kivétel
Nehézség: ★☆☆ könnyű
"""

def dict_access(d, key):
    return d[key]
%%submit task12-file-read

"""
Feladat: Fájl beolvasása
Leírás: Készíts egy függvényt, amely elolvassa a fájl tartalmát.
Függvény neve: file_read
Paraméterek: filename (fájlnév)
Visszatérési érték: a fájl tartalma
Példa: file_read('adat.txt') → a fájl teljes tartalma;  nem létező fájlnál FileNotFoundError
Nehézség: ★☆☆ könnyű
"""

def file_read(filename):
    with open(filename,'r') as f:
        return f.read()
%%submit task13-exception-handling

"""
Feladat: Kivételkezelés
Leírás: Készíts egy függvényt, amely biztosítja, hogy hibakezelést végez.
Függvény neve: exception_handling
Paraméterek: x (egész szám)
Visszatérési érték: x osztva 2-vel, vagy hiba esetén nullát
Példa: exception_handling(10) → 5.0;  exception_handling('hello') → 0.0
Nehézség: ★☆☆ könnyű
"""

def exception_handling(x):
    try:
        return x/2
    except Exception:
        return 0.0
%%submit task14-regex-match

"""
Feladat: Reguláris kifejezés
Leírás: Készíts egy függvényt, amely ellenőrzi, hogy a szöveg megfelel-e a regex kifejezésnek.
Függvény neve: regex_match
Paraméterek: text (szöveg), pattern (regex minta)
Visszatérési érték: boolean érték (True, ha van egyezés, különben False)
Példa: regex_match('hello world', r'world') → True  (bárhol a szövegben)
Nehézség: ★☆☆ könnyű
"""

def regex_match(text, pattern):
    import re
    return bool(re.search(pattern, text))
%%submit task15-sort-list

"""
Feladat: Lista rendezése
Leírás: Készíts egy függvényt, amely rendez egy listát.
Függvény neve: sort_list
Paraméterek: lst (lista)
Visszatérési érték: rendezett lista
Példa: sort_list([3, 1, 2]) → [1, 2, 3]
Nehézség: ★☆☆ könnyű
"""

def sort_list(lst):
    return sorted(lst)
%%submit task16-count-vowels

"""
Feladat: Magánhangzók száma
Leírás: Készíts egy függvényt, amely megszámolja a magánhangzókat egy szövegben.
Függvény neve: count_vowels
Paraméterek: text (szöveg)
Visszatérési érték: magánhangzók száma (egész szám)
Példa: count_vowels('Árvíztűrő') → 4  (ékezetes és nagybetűs magánhangzók is)
Nehézség: ★☆☆ könnyű
"""

def count_vowels(text):
    maganhangzok = "aeiouáéíóöőúüűAEIOUÁÉÍÓÖŐÚÜŰ"
    sum =0
    for t in text:
        if t in maganhangzok:
            sum += 1
    return sum
%%submit task17-reverse-string

"""
Feladat: Szöveg megfordítása
Leírás: Készíts egy függvényt, amely megfordít egy szöveget.
Függvény neve: reverse_string
Paraméterek: text (szöveg)
Visszatérési érték: megfordított szöveg
Példa: reverse_string('hello') → 'olleh'
Nehézség: ★☆☆ könnyű
"""

def reverse_string(s):
    return s[::-1]
%%submit task18-factorial

"""
Feladat: Faktoriális
Leírás: Készíts egy függvényt, amely kiszámítja egy szám faktoriálisát.
Függvény neve: factorial
Paraméterek: n (nem negatív egész szám)
Visszatérési érték: n faktoriálisa (egész szám)
Példa: factorial(5) → 120,  factorial(0) → 1
Nehézség: ★☆☆ könnyű
"""

def factorial(n):
    if n == 0:
        return 1
    for i in range(1, n):
        n *= i
    return n
%%submit task19-palindrome-check

"""
Feladat: Palindrom-e
Leírás: Készíts egy függvényt, amely ellenőrzi, hogy egy szöveg palindróma-e.
Függvény neve: is_palindrome
Paraméterek: text (szöveg)
Visszatérési érték: True, ha palindróma, False egyébként
Példa: is_palindrome('Géza kék az ég') → True  (kis-/nagybetű és szóköz nem számít)
Nehézség: ★☆☆ könnyű
"""

def is_palindrome(s):
    s = ''.join(c.lower() for c in s if c.isalnum())  # kisbetűs és csak alfanumerikus karakterek
    d = s[::-1]
    return True if s==d else False
%%submit task20-sum-list

"""
Feladat: Lista összege
Leírás: Készíts egy függvényt, amely kiszámítja egy számok listájának összegét.
Függvény neve: sum_list
Paraméterek: numbers (számok listája)
Visszatérési érték: számok összege
Példa: sum_list([1, 2, 3]) → 6
Nehézség: ★☆☆ könnyű
"""

def sum_list(lst):
    summ = 0
    for n in lst:
        summ += n
    return summ

%%submit task21-szavak-szama

"""
Feladat: Szavak száma
Leírás: Készíts egy függvényt, amely megszámolja, hány szó van egy szövegben. Szónak a
        szóközzel, tabulátorral vagy sortöréssel elválasztott részeket tekintjük (akár több
        elválasztó is lehet egymás után).
Függvény neve: szavak_szama
Paraméterek: szoveg (str)
Visszatérési érték: a szavak száma (int)
Példa: szavak_szama('Szia  világ!') → 2
Nehézség: ★☆☆ könnyű
"""

def szavak_szama(szoveg):
        return len(szoveg.split())
%%submit task22-nagy-kezdobetuk

"""
Feladat: Nagy kezdőbetűk
Leírás: Készíts egy függvényt, amely a szöveg minden szavát nagy kezdőbetűvel, a többi betűjét
        kisbetűvel írja. Az eredményben a szavakat pontosan egy szóköz válassza el (a felesleges
        szóközök tűnjenek el).
Függvény neve: nagy_kezdobetuk
Paraméterek: szoveg (str)
Visszatérési érték: az átalakított szöveg (str)
Példa: nagy_kezdobetuk('KECSKEMÉT  város') → 'Kecskemét Város'
Nehézség: ★☆☆ könnyű
"""

def nagy_kezdobetuk(szoveg):
    szavak = szoveg.split()
    return  ' '.join(s.capitalize()for s in szavak)

%%submit task23-anagramma

"""
Feladat: Anagramma
Leírás: Két szöveg anagramma, ha ugyanazokból a betűkből állnak (ugyanannyiszor). A kis- és
        nagybetűt ne különböztesd meg, a szóközöket hagyd figyelmen kívül.
Függvény neve: anagramma
Paraméterek: a (str), b (str)
Visszatérési érték: True, ha anagrammák, különben False
Példa: anagramma('Dormitory', 'dirty room') → True
Nehézség: ★★☆ közepes
"""

def anagramma(a, b):
        c = ''.join(a.lower().split())
        d = ''.join(b.lower().split())
        return sorted(c) == sorted(d)

%%submit task24-caesar

"""
Feladat: Caesar-rejtjel
Leírás: Valósítsd meg a Caesar-rejtjelet: az angol ábécé betűit (a–z, A–Z) told el a megadott
        lépéssel, körbeérve (z után a). A kis- és nagybetű maradjon meg, minden más karakter
        (szóköz, írásjel, ékezetes betű) változatlan. Az eltolás lehet negatív és 26-nál nagyobb
        is.
Függvény neve: caesar
Paraméterek: szoveg (str), eltolas (int)
Visszatérési érték: a titkosított szöveg (str)
Példa: caesar('Hello, World!', 5) → 'Mjqqt, Btwqi!'
Nehézség: ★★☆ közepes
"""

def caesar(szoveg, eltolas):
    eredmeny = ""

    for karakter in szoveg:

        if "a" <= karakter <= "z":
            pozicio = ord(karakter) - ord("a")
            uj_pozicio = (pozicio + eltolas) % 26
            eredmeny += chr(uj_pozicio + ord("a"))

        elif "A" <= karakter <= "Z":
            pozicio = ord(karakter) - ord("A")
            uj_pozicio = (pozicio + eltolas) % 26
            eredmeny += chr(uj_pozicio + ord("A"))

        else:
            eredmeny += karakter

    return eredmeny                 
%%submit task25-tomorites

"""
Feladat: Szöveg tömörítése
Leírás: Tömörítsd a szöveget úgy, hogy az egymás után ismétlődő karaktereket a karakter és az
        ismétlések száma helyettesítse. Ha egy karakter csak egyszer fordul elő egymás után, a
        szám maradjon el. A kis- és nagybetű különbözik.
Függvény neve: tomorites
Paraméterek: s (str)
Visszatérési érték: a tömörített szöveg (str)
Példa: tomorites('aaabccdddd') → 'a3bc2d4'
Nehézség: ★★☆ közepes
"""

def tomorites(s):
        if not s:
                return ""
        counter = 1
        result = ""

        for i in range(1,len(s)):
                if s[i] == s[i-1]:
                        counter +=1
                else:
                        result +=s[i-1]
                        if counter > 1:
                                result += str(counter)
                        counter = 1

        result += s[-1]
        if counter > 1:
                result += str(counter)
        return result
%%submit task26-leghosszabb-szo

"""
Feladat: Leghosszabb szó
Leírás: Add vissza a szöveg leghosszabb szavát (a szavakat whitespace választja el). Ha több
        egyformán hosszú van, az elsőt. Üres szövegre üres stringet.
Függvény neve: leghosszabb_szo
Paraméterek: szoveg (str)
Visszatérési érték: a leghosszabb szó (str)
Példa: leghosszabb_szo('a kecskeméti tanya') → 'kecskeméti'
Nehézség: ★☆☆ könnyű
"""

def leghosszabb_szo(szoveg):
        if not szoveg or szoveg =="":
                return ""

        szavak = szoveg.split()
        index =0
        for i in range(len(szavak)):
                if len(szavak[i]) > len(szavak[index]):
                        index = i
        return szavak[index]
%%submit task27-betugyakorisag

"""
Feladat: Betűgyakoriság
Leírás: Készíts szótárat arról, hogy a szövegben melyik betű hányszor fordul elő. Csak a betűket
        számold (számjegyet, szóközt, írásjelet nem), és a kis- és nagybetűt ne különböztesd meg
        (kisbetűs kulcsok).
Függvény neve: betugyakorisag
Paraméterek: szoveg (str)
Visszatérési érték: szótár: betű → darabszám (dict)
Példa: betugyakorisag('Alma') → {'a': 2, 'l': 1, 'm': 1}
Nehézség: ★★☆ közepes
"""

def betugyakorisag(szoveg):
        gyakorisag = {}
        for karakter in szoveg:
                if karakter.isalpha():
                        karakter = karakter.lower()
                        if karakter in gyakorisag:
                                gyakorisag[karakter]+=1
                        else:
                                gyakorisag[karakter]=1
        return gyakorisag
        
%%submit task28-email-ellenorzes

"""
Feladat: E-mail-cím ellenőrzése
Leírás: Ellenőrizd egy e-mail-cím formáját az alábbi (egyszerűsített) szabályok szerint:
        pontosan egy `@` van benne; nincs benne szóköz; a `@` előtti rész nem üres; a `@` utáni
        rész (domain) tartalmaz pontot, de nem kezdődik és nem végződik ponttal, és nincs benne
        két egymás utáni pont.
Függvény neve: ervenyes_email
Paraméterek: cim (str)
Visszatérési érték: True, ha érvényes, különben False
Példa: ervenyes_email('diak@gamf.hu') → True
Nehézség: ★★☆ közepes
"""

def ervenyes_email(cim):
        return cim.count("@") == 1 and " " not in cim and cim.index("@") > 0 and "." in cim.split("@")[1] and not cim.split("@")[1].startswith(".") and not cim.split("@")[1].endswith(".") and ".." not in cim.split("@")[1]

%%submit task29-masodik-legnagyobb

"""
Feladat: Második legnagyobb
Leírás: Add vissza a lista második legnagyobb **különböző** értékét. Ha nincs ilyen (üres lista,
        egy elem, vagy minden elem egyforma), adj vissza `None`-t.
Függvény neve: masodik_legnagyobb
Paraméterek: szamok (list[int])
Visszatérési érték: a második legnagyobb érték vagy None
Példa: masodik_legnagyobb([3, 1, 4, 1, 5]) → 4
Nehézség: ★★☆ közepes
"""

def masodik_legnagyobb(szamok):
        if len(szamok) < 2:
                return None
        egyedi_szamok = list(set(szamok))
        if len(egyedi_szamok) < 2:
                return None
        egyedi_szamok.sort(reverse=True)
        return egyedi_szamok[1]
%%submit task30-darabolas

"""
Feladat: Lista darabolása
Leírás: Oszd fel a listát `n` hosszú darabokra (listák listája). Az utolsó darab rövidebb lehet.
Függvény neve: darabolas
Paraméterek: lista (list), n (int, n ≥ 1)
Visszatérési érték: a darabok listája (list[list])
Példa: darabolas([1, 2, 3, 4, 5], 2) → [[1, 2], [3, 4], [5]]
Nehézség: ★☆☆ könnyű
"""

def darabolas(lista, n):
    return [lista[i:i+n] for i in range(0,len(lista), n)]
%%submit task31-kisimitas

"""
Feladat: Beágyazott lista kisimítása
Leírás: Egy lista elemei között tetszőleges mélységben további listák lehetnek. Add vissza az
        összes nem-lista elemet egyetlen lapos listában, eredeti sorrendben. (A stringeket ne
        bontsd betűkre.)
Függvény neve: kisimitas
Paraméterek: lista (list)
Visszatérési érték: lapos lista (list)
Példa: kisimitas([1, [2, 3], [4, [5, [6]]]]) → [1, 2, 3, 4, 5, 6]
Nehézség: ★★★ nehezebb
"""

def kisimitas(lista):
        eredmeny = []
        for elem in lista:
                if isinstance(elem,list):
                        eredmeny.extend(kisimitas(elem))
                else:
                        eredmeny.append(elem)
        return eredmeny
%%submit task32-forgatas

"""
Feladat: Lista forgatása
Leírás: Forgasd el a listát jobbra `k` lépéssel: az utolsó `k` elem kerüljön az elejére. `k`
        lehet nagyobb a lista hosszánál is. Üres listára üres listát adj vissza. Az eredeti
        listát ne módosítsd.
Függvény neve: forgatas
Paraméterek: lista (list), k (int, k ≥ 0)
Visszatérési érték: az elforgatott új lista
Példa: forgatas([1, 2, 3, 4, 5], 2) → [4, 5, 1, 2, 3]
Nehézség: ★☆☆ könnyű
"""

def forgatas(lista, k):
        if not lista:
                return []
        k = k % len(lista)
        return lista[-k:] + lista[:-k]

%%submit task33-rendezett-osszefesules

"""
Feladat: Rendezett listák összefésülése
Leírás: Két növekvő sorrendben rendezett listából készíts egyetlen rendezett listát. Próbáld meg
        `sorted()` és `sort()` nélkül, egyetlen bejárással (két „mutatóval”) megoldani.
Függvény neve: osszefesul
Paraméterek: a (list), b (list) – mindkettő rendezett
Visszatérési érték: rendezett lista az összes elemmel
Példa: osszefesul([1, 3, 5], [2, 4, 6]) → [1, 2, 3, 4, 5, 6]
Nehézség: ★★☆ közepes
"""

def osszefesul(a, b):
    eredmeny = []
    i = 0
    j = 0

    while i < len(a) and j < len(b):
        if a[i] <= b[j]:
            eredmeny.append(a[i])
            i += 1
        else:
            eredmeny.append(b[j])
            j += 1

    eredmeny.extend(a[i:])
    eredmeny.extend(b[j:])

    return eredmeny

%%submit task34-mozgo-atlag

"""
Feladat: Mozgóátlag
Leírás: Számold ki a lista `k` hosszú, egymást követő ablakainak átlagát, két tizedesjegyre
        kerekítve. Ha `k` nagyobb a lista hosszánál, üres listát adj vissza.
Függvény neve: mozgo_atlag
Paraméterek: szamok (list[int|float]), k (int, k ≥ 1)
Visszatérési érték: az átlagok listája (list[float])
Példa: mozgo_atlag([1, 2, 3, 4, 5], 3) → [2.0, 3.0, 4.0]
Nehézség: ★★☆ közepes
"""

def mozgo_atlag(szamok, k):
        eredmeny = []
        if k > len(szamok):
                return eredmeny
        for i in range(len(szamok)  -k+1):
                ablak = szamok[i:i+k]
                atlag = round(sum(ablak)/k,2)
                eredmeny.append(atlag)
        return eredmeny
%%submit task35-transzponalas

"""
Feladat: Mátrix transzponálása
Leírás: Egy mátrixot listák listájaként kapsz (minden sor ugyanolyan hosszú). Add vissza a
        transzponáltját: az i. sor j. eleméből a j. sor i. eleme lesz. Az eredmény is listák
        listája legyen. Üres mátrixra üres listát.
Függvény neve: transzponal
Paraméterek: matrix (list[list])
Visszatérési érték: a transzponált mátrix (list[list])
Példa: transzponal([[1, 2, 3], [4, 5, 6]]) → [[1, 4], [2, 5], [3, 6]]
Nehézség: ★☆☆ könnyű
"""

def transzponal(matrix):
    if not matrix:
        return []

    eredmeny = []

    for j in range(len(matrix[0])):
        sor = []

        for i in range(len(matrix)):
            sor.append(matrix[i][j])

        eredmeny.append(sor)

    return eredmeny

%%submit task36-pascal-haromszog

"""
Feladat: Pascal-háromszög
Leírás: Add vissza a Pascal-háromszög első `n` sorát listák listájaként. Minden sor 1-gyel
        kezdődik és végződik, a belső elemek a felette lévő két szám összegei.
Függvény neve: pascal
Paraméterek: n (int, n ≥ 0)
Visszatérési érték: a sorok listája (list[list[int]])
Példa: pascal(4) → [[1], [1, 1], [1, 2, 1], [1, 3, 3, 1]]
Nehézség: ★★☆ közepes
"""

def pascal(n):
    eredmeny = []

    for i in range(n):
        sor = [1] * (i + 1)

        for j in range(1, i):
            sor[j] = eredmeny[i - 1][j - 1] + eredmeny[i - 1][j]

        eredmeny.append(sor)

    return eredmeny

%%submit task37-szotar-megforditas

"""
Feladat: Szótár megfordítása
Leírás: Fordítsd meg a szótárat: az értékekből legyenek a kulcsok, a kulcsokból az értékek.
        Feltételezheted, hogy minden érték különböző (és hashelhető).
Függvény neve: megfordit
Paraméterek: szotar (dict)
Visszatérési érték: a megfordított szótár (dict)
Példa: megfordit({'a': 1, 'b': 2}) → {1: 'a', 2: 'b'}
Nehézség: ★☆☆ könnyű
"""

def megfordit(szotar):
    eredmeny = {}

    for kulcs, ertek in szotar.items():
        eredmeny[ertek] = kulcs

    return eredmeny
%%submit task38-csoportositas-hossz

"""
Feladat: Csoportosítás hossz szerint
Leírás: Csoportosítsd a szavakat a hosszuk szerint: a szótár kulcsa a hossz, az értéke az ilyen
        hosszú szavak listája az eredeti sorrendben.
Függvény neve: hossz_szerint
Paraméterek: szavak (list[str])
Visszatérési érték: szótár: hossz → szavak listája (dict)
Példa: hossz_szerint(['alma', 'ló', 'kő']) → {4: ['alma'], 2: ['ló', 'kő']}
Nehézség: ★★☆ közepes
"""

def hossz_szerint(szavak):
    eredmeny = {}

    for szo in szavak:
        hossz = len(szo)

        if hossz not in eredmeny:
            eredmeny[hossz] = []

        eredmeny[hossz].append(szo)

    return eredmeny

%%submit task39-szotarak-osszege

"""
Feladat: Szótárak összeadása
Leírás: Két szótár értékei számok. Készíts új szótárat, amelyben minden kulcs szerepel, ami
        bármelyikben szerepel; a közös kulcsoknál az értékek összege legyen. A bemeneti
        szótárakat ne módosítsd.
Függvény neve: osszead
Paraméterek: a (dict), b (dict)
Visszatérési érték: az összesített szótár (dict)
Példa: osszead({'a': 1, 'b': 2}, {'b': 3, 'c': 4}) → {'a': 1, 'b': 5, 'c': 4}
Nehézség: ★★☆ közepes
"""

def osszead(a, b):
    eredmeny = a.copy()

    for kulcs, ertek in b.items():
        eredmeny[kulcs] = eredmeny.get(kulcs, 0) + ertek

    return eredmeny

%%submit task40-leggyakoribb-szavak

"""
Feladat: Leggyakoribb szavak
Leírás: Add vissza a szöveg `k` leggyakoribb szavát `(szó, darabszám)` tuple-ök listájaként,
        gyakoriság szerint csökkenő sorrendben; azonos gyakoriságnál ábécé szerint. A szavakat
        kisbetűsítsd, és vedd le róluk a `.,!?;:` írásjeleket.
Függvény neve: top_szavak
Paraméterek: szoveg (str), k (int, k ≥ 0)
Visszatérési érték: list[tuple[str, int]]
Példa: top_szavak('a kutya és a macska és a ló', 2) → [('a', 3), ('és', 2)]
Nehézség: ★★★ nehezebb
"""

def top_szavak(szoveg, k):
    gyakorisag = {}

    for szo in szoveg.lower().split():
        szo = szo.strip(".,!?;:")

        if szo == "":
            continue

        if szo in gyakorisag:
            gyakorisag[szo] += 1
        else:
            gyakorisag[szo] = 1

    eredmeny = sorted(
        gyakorisag.items(),
        key=lambda x: (-x[1], x[0])
    )

    return eredmeny[:k]

%%submit task41-jegyatlag

"""
Feladat: Jegyátlagok
Leírás: A bemenet egy szótár: név → jegyek listája. Készíts szótárat név → átlag (két tizedesre
        kerekítve) párokkal. Akinek nincs jegye (üres lista), annál az érték `None` legyen.
Függvény neve: atlagok
Paraméterek: jegyek (dict[str, list[int]])
Visszatérési érték: dict[str, float | None]
Példa: atlagok({'Anna': [5, 4, 5], 'Béla': [3, 3]}) → {'Anna': 4.67, 'Béla': 3.0}
Nehézség: ★★☆ közepes
"""

def atlagok(jegyek):
    eredmeny = {}

    for nev, lista in jegyek.items():
        if len(lista) == 0:
            eredmeny[nev] = None
        else:
            atlag = sum(lista) / len(lista)
            eredmeny[nev] = round(atlag, 2)

    return eredmeny

%%submit task42-fizzbuzz

"""
Feladat: FizzBuzz
Leírás: Add vissza az 1-től n-ig tartó számok szöveges listáját azzal, hogy a 3-mal osztható
        számok helyett `'Fizz'`, az 5-tel oszthatók helyett `'Buzz'`, a 15-tel oszthatók helyett
        `'FizzBuzz'` szerepeljen.
Függvény neve: fizzbuzz
Paraméterek: n (int, n ≥ 0)
Visszatérési érték: list[str]
Példa: fizzbuzz(5) → ['1', '2', 'Fizz', '4', 'Buzz']
Nehézség: ★☆☆ könnyű
"""

def fizzbuzz(n):
    eredmeny = []

    for i in range(1, n + 1):
        if i % 15 == 0:
            eredmeny.append("FizzBuzz")

        elif i % 3 == 0:
            eredmeny.append("Fizz")

        elif i % 5 == 0:
            eredmeny.append("Buzz")

        else:
            eredmeny.append(str(i))

    return eredmeny

%%submit task43-prim

"""
Feladat: Prímszám-e
Leírás: Döntsd el, hogy egy egész szám prímszám-e. (Az 1, a 0 és a negatív számok nem prímek.)
Függvény neve: prim_e
Paraméterek: n (int)
Visszatérési érték: True, ha prím, különben False
Példa: prim_e(17) → True
Nehézség: ★☆☆ könnyű
"""

def prim_e(n):
    if n < 2:
        return False

    for i in range(2, n):
        if n % i == 0:
            return False

    return True

%%submit task44-lnko

"""
Feladat: Legnagyobb közös osztó
Leírás: Számold ki két egész szám legnagyobb közös osztóját az euklideszi algoritmussal. Az
        eredmény mindig nemnegatív legyen; `lnko(0, 0)` értéke 0.
Függvény neve: lnko
Paraméterek: a (int), b (int)
Visszatérési érték: a legnagyobb közös osztó (int)
Példa: lnko(12, 18) → 6
Nehézség: ★☆☆ könnyű
"""

def lnko(a, b):
    a = abs(a)
    b = abs(b)

    while b != 0:
        maradek = a % b
        a = b
        b = maradek

    return a


%%submit task45-fibonacci

"""
Feladat: Fibonacci-sorozat
Leírás: Add vissza a Fibonacci-sorozat első n elemét (0, 1, 1, 2, 3, 5, …).
Függvény neve: fibonacci
Paraméterek: n (int, n ≥ 0)
Visszatérési érték: list[int]
Példa: fibonacci(7) → [0, 1, 1, 2, 3, 5, 8]
Nehézség: ★☆☆ könnyű
"""

def fibonacci(n):
    eredmeny = []
    a = 0
    b = 1

    for i in range(n):
        eredmeny.append(a)

        kovetkezo = a + b
        a = b
        b = kovetkezo

    return eredmeny

%%submit task46-digitalis-gyok

"""
Feladat: Digitális gyök
Leírás: Add össze a szám számjegyeit, majd az eredmény számjegyeit, és így tovább, amíg egyjegyű
        számot nem kapsz. Negatív számnál az abszolút értékkel dolgozz. Oldd meg rekurzívan!
Függvény neve: digitalis_gyok
Paraméterek: n (int)
Visszatérési érték: egyjegyű szám (int)
Példa: digitalis_gyok(38) → 2   (3 + 8 = 11 → 1 + 1 = 2)
Nehézség: ★★☆ közepes
"""

def digitalis_gyok(n):
    n = abs(n)

    if n < 10:
        return n

    osszeg = 0

    for szamjegy in str(n):
        osszeg += int(szamjegy)

    return digitalis_gyok(osszeg)

%%submit task47-binaris-kereses

"""
Feladat: Bináris keresés
Leírás: Egy növekvő sorrendben rendezett, ismétlődés nélküli listában keresd meg a megadott
        érték indexét bináris kereséssel. Ha nincs benne, adj vissza -1-et. (Ne használd az
        `index()` metódust és az `in` operátort!)
Függvény neve: binaris_kereses
Paraméterek: lista (list[int], rendezett), ertek (int)
Visszatérési érték: az index vagy -1
Példa: binaris_kereses([1, 3, 5, 7, 9], 7) → 3
Nehézség: ★★☆ közepes
"""

def binaris_kereses(lista, ertek):
    bal = 0
    jobb = len(lista) - 1

    while bal <= jobb:
        kozep = (bal + jobb) // 2

        if lista[kozep] == ertek:
            return kozep

        elif lista[kozep] < ertek:
            bal = kozep + 1

        else:
            jobb = kozep - 1

    return -1

%%submit task48-romai-szam

"""
Feladat: Római szám értéke
Leírás: Alakítsd át a római számot egész számmá. Jelek: I=1, V=5, X=10, L=50, C=100, D=500,
        M=1000. Ha egy kisebb jel egy nagyobb előtt áll, ki kell vonni (IV = 4, IX = 9, XL = 40,
        XC = 90, CD = 400, CM = 900). A bemenet mindig érvényes, nagybetűs római szám.
Függvény neve: romai_ertek
Paraméterek: s (str)
Visszatérési érték: int
Példa: romai_ertek('MCMXCIV') → 1994
Nehézség: ★★★ nehezebb
"""

def romai_ertek(s):
    ertekek = {
        "I": 1,
        "V": 5,
        "X": 10,
        "L": 50,
        "C": 100,
        "D": 500,
        "M": 1000
    }

    eredmeny = 0

    for i in range(len(s)):
        aktualis = ertekek[s[i]]

        if i + 1 < len(s) and aktualis < ertekek[s[i + 1]]:
            eredmeny -= aktualis
        else:
            eredmeny += aktualis

    return eredmeny

%%submit task49-zarojelek

"""
Feladat: Zárójelek egyensúlya
Leírás: Döntsd el, hogy a szövegben a `()`, `[]`, `{}` zárójelek helyesen vannak-e párosítva és
        egymásba ágyazva. Minden más karaktert hagyj figyelmen kívül.
Függvény neve: kiegyensulyozott
Paraméterek: s (str)
Visszatérési érték: True, ha kiegyensúlyozott, különben False
Példa: kiegyensulyozott('print(x[0])') → True,  kiegyensulyozott('([)]') → False
Nehézség: ★★★ nehezebb
"""

def kiegyensulyozott(s):
    verem = []

    parok = {
        ")": "(",
        "]": "[",
        "}": "{"
    }

    for karakter in s:
        if karakter in "([{":
            verem.append(karakter)

        elif karakter in parok:
            if not verem:
                return False

            if verem.pop() != parok[karakter]:
                return False

    return len(verem) == 0

%%submit task50-biztonsagos-osztas

"""
Feladat: Biztonságos osztás
Leírás: Oszd el `a`-t `b`-vel. Ha nullával osztanál, vagy valamelyik bemenet nem szám (pl.
        szöveg), ne álljon le a program: ilyenkor adj vissza `None`-t.
Függvény neve: biztonsagos_osztas
Paraméterek: a, b
Visszatérési érték: a / b (float) vagy None
Példa: biztonsagos_osztas(7, 2) → 3.5,  biztonsagos_osztas(1, 0) → None
Nehézség: ★☆☆ könnyű
"""

def biztonsagos_osztas(a, b):
    try:
        return a / b
    except (ZeroDivisionError, TypeError):
        return None

%%submit task51-szamlista-beolvasas

"""
Feladat: Számlista beolvasása
Leírás: A bemenet vesszővel elválasztott értékek szövege (az elemek körül szóköz lehet). Add
        vissza azoknak az elemeknek a listáját egész számként, amelyek egész számmá alakíthatók;
        a többit hagyd ki.
Függvény neve: szamok
Paraméterek: szoveg (str)
Visszatérési érték: list[int]
Példa: szamok('1, x, 3') → [1, 3]
Nehézség: ★★☆ közepes
"""

def szamok(szoveg):
    eredmeny = []

    for elem in szoveg.split(","):
        try:
            eredmeny.append(int(elem))
        except :
            continue

    return eredmeny

%%submit task52-eletkor-ellenorzes

"""
Feladat: Életkor ellenőrzése
Leírás: Alakítsd a bemenetet (szöveg vagy egész szám) egész számmá, és ellenőrizd, hogy érvényes
        életkor-e (0 és 130 között, a határokat is beleértve). Ha nem alakítható számmá, vagy
        kívül esik a tartományon, dobj `ValueError` kivételt beszédes üzenettel.
Függvény neve: eletkor
Paraméterek: ertek (str | int)
Visszatérési érték: az életkor (int)
Példa: eletkor(' 42 ') → 42,  eletkor('negyven') → ValueError
Nehézség: ★★☆ közepes
"""

def eletkor(ertek):
    try:
        kor = int(ertek)
    except (ValueError, TypeError):
        raise ValueError("Az életkor nem alakítható egész számmá.")

    if kor < 0 or kor > 130:
        raise ValueError("Az életkornak 0 és 130 között kell lennie.")

    return kor
%%submit task53-sorok-szama

"""
Feladat: Nem üres sorok száma
Leírás: Számold meg, hány nem üres sor van egy UTF-8 kódolású szövegfájlban. A csak
        szóközt/tabulátort tartalmazó sor üresnek számít. Ha a fájl nem létezik, a
        `FileNotFoundError` jusson ki a függvényből (ne kapd el).
Függvény neve: sorok_szama
Paraméterek: fajlnev (str)
Visszatérési érték: int
Példa: egy\nkettő\n\nhárom → 3
Nehézség: ★☆☆ könnyű
"""

def sorok_szama(fajlnev):
    szamlalo = 0

    with open(fajlnev, "r", encoding="utf-8") as fajl:
        for sor in fajl:
            if sor.strip() != "":
                szamlalo += 1

    return szamlalo

%%submit task54-csv-atlag

"""
Feladat: CSV-átlag
Leírás: A fájl pontosvesszővel tagolt CSV, az első sora a fejléc: `nev;pont`. Számold ki a
        pontszámok átlagát két tizedesre kerekítve. Az üres sorokat hagyd ki. Ha nincs egyetlen
        adatsor sem, adj vissza `None`-t.
Függvény neve: pont_atlag
Paraméterek: fajlnev (str)
Visszatérési érték: float vagy None
Példa: nev;pont / Anna;45 / Béla;38 / Cili;50 → 44.33
Nehézség: ★★☆ közepes
"""

def pont_atlag(fajlnev):
        pontok = []
        with open(fajlnev,'r',encoding='utf-8') as fajl:
                next(fajl,None)
                for line in fajl:
                        if line.strip()=="":
                                continue
                        adatok=line.split(";")
                        pontok.append(float(adatok[1]))

        return round(sum(pontok)/len(pontok),2) if pontok else None 


%%submit task55-fajl-szogyakorisag

"""
Feladat: Leggyakoribb szavak fájlban
Leírás: Olvasd be az UTF-8 kódolású szövegfájlt, és add vissza a 3 leggyakoribb szót `(szó,
        darabszám)` tuple-ök listájaként: gyakoriság szerint csökkenő, azonos gyakoriságnál
        ábécé szerinti sorrendben. A szavakat kisbetűsítsd, és vedd le róluk a `.,!?;:`
        írásjeleket. Ha háromnál kevesebb szó van, mindet add vissza.
Függvény neve: top3_fajl
Paraméterek: fajlnev (str)
Visszatérési érték: list[tuple[str, int]]
Példa: 'Az alma piros. Az alma édes! A körte sárga, az alma is.' → [('alma', 3), ('az', 3),
       ('a', 1)]
Nehézség: ★★★ nehezebb
"""

def top3_fajl(fajlnev):
    gyakorisag = {}

    with open(fajlnev, "r", encoding="utf-8") as fajl:
        szoveg = fajl.read().lower()

        for szo in szoveg.split():
            szo = szo.strip(".,!?;:")

            if szo == "":
                continue

            if szo in gyakorisag:
                gyakorisag[szo] += 1
            else:
                gyakorisag[szo] = 1

    eredmeny = sorted(
        gyakorisag.items(),
        key=lambda x: (-x[1], x[0])
    )

    return eredmeny[:3]

%%submit task56-szamlalo

"""
Feladat: Számláló osztály
Leírás: Készíts `Szamlalo` osztályt. A konstruktor kezdőértéket kap (alapértéke 0), amit az
        `ertek` attribútumban tárol. A `novel()` metódus eggyel növeli az értéket, és
        **visszaadja az új értéket**; a `nullaz()` metódus 0-ra állítja (és nem ad vissza
        semmit).
Osztály neve: Szamlalo
Paraméterek: Szamlalo(kezdo=0); metódusok: novel(), nullaz(); attribútum: ertek
Visszatérési érték: novel() → az új érték (int); nullaz() → None
Példa: s = Szamlalo(10); s.novel() → 11; s.ertek → 11
Nehézség: ★☆☆ könnyű
"""

class Szamlalo:
    def __init__(self, kezdo=0):
        self.ertek=kezdo

    def novel(self):
        self.ertek+=1
        return self.ertek

    def nullaz(self):
        self.ertek=0

%%submit task57-teglalap

"""
Feladat: Téglalap osztály
Leírás: Készíts `Teglalap` osztályt, amely két oldalhosszt kap (`a`, `b`). Ha bármelyik oldal
        nem pozitív, a konstruktor dobjon `ValueError` kivételt. Metódusok: `terulet()`,
        `kerulet()`, `negyzet_e()` (True, ha a két oldal egyenlő).
Osztály neve: Teglalap
Paraméterek: Teglalap(a, b); metódusok: terulet(), kerulet(), negyzet_e()
Visszatérési érték: terület, kerület (szám), negyzet_e (bool)
Példa: t = Teglalap(3, 4); t.terulet() → 12; t.kerulet() → 14; t.negyzet_e() → False
Nehézség: ★★☆ közepes
"""

class Teglalap:
    def __init__(self, a, b):
        if a <= 0 or b <= 0:
            raise ValueError("Az oldalhosszaknak pozitívnak kell lenniük.")

        self.a = a
        self.b = b

    def terulet(self):
        return self.a * self.b

    def kerulet(self):
        return 2 * (self.a + self.b)

    def negyzet_e(self):
        return self.a == self.b

%%submit task58-bankszamla

"""
Feladat: Bankszámla osztály
Leírás: Készíts `Bankszamla` osztályt. Konstruktor: `tulajdonos` (str) és `egyenleg` (alapértéke
        0), mindkettő attribútumként érhető el. `befizet(osszeg)`: növeli az egyenleget és
        visszaadja az új egyenleget; nem pozitív összegnél `ValueError`. `kivesz(osszeg)`:
        csökkenti az egyenleget és visszaadja az újat; nem pozitív összegnél vagy ha nincs rá
        fedezet, `ValueError` (és az egyenleg nem változik). `str(szamla)` alakja: `'Anna: 1500
        Ft'`.
Osztály neve: Bankszamla
Paraméterek: Bankszamla(tulajdonos, egyenleg=0); befizet(osszeg), kivesz(osszeg), __str__()
Visszatérési érték: befizet/kivesz → új egyenleg; str → 'Név: N Ft'
Példa: sz = Bankszamla('Anna', 1000); sz.befizet(500) → 1500; str(sz) → 'Anna: 1500 Ft'
Nehézség: ★★☆ közepes
"""

class Bankszamla:
    def __init__(self, tulajdonos, egyenleg=0):
        self.tulajdonos = tulajdonos
        self.egyenleg = egyenleg

    def befizet(self, osszeg):
        if osszeg <= 0:
            raise ValueError("Az összegnek pozitívnak kell lennie.")

        self.egyenleg += osszeg
        return self.egyenleg

    def kivesz(self, osszeg):
        if osszeg <= 0:
            raise ValueError("Az összegnek pozitívnak kell lennie.")

        if osszeg > self.egyenleg:
            raise ValueError("Nincs elegendő fedezet.")

        self.egyenleg -= osszeg
        return self.egyenleg

    def __str__(self):
        return f"{self.tulajdonos}: {self.egyenleg} Ft"

%%submit task59-verem

"""
Feladat: Verem osztály
Leírás: Valósíts meg egy vermet (LIFO) `Verem` osztályként. Metódusok: `push(elem)` – betesz
        (nem ad vissza semmit); `pop()` – kiveszi és visszaadja a legfelső elemet; `peek()` –
        visszaadja a legfelső elemet kivétel nélkül; `ures()` – True, ha üres; `meret()` – az
        elemek száma. Üres veremnél a `pop()` és a `peek()` dobjon `IndexError`-t. Minden
        veremnek saját tartalma legyen!
Osztály neve: Verem
Paraméterek: Verem(); push(elem), pop(), peek(), ures(), meret()
Visszatérési érték: lásd a leírást
Példa: v = Verem(); v.push(1); v.push(2); v.pop() → 2; v.meret() → 1
Nehézség: ★★★ nehezebb
"""
class Verem:
    def __init__(self):
        self.elemek = []

    def push(self, elem):
        self.elemek.append(elem)

    def pop(self):
        return self.elemek.pop()

    def peek(self):
        return self.elemek[-1]

    def ures(self):
        return len(self.elemek) == 0

    def meret(self):
        return len(self.elemek)

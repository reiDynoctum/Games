const odkazyNavigace = document.getElementById('odkazy');
const otevritMobilniNavigaci = document.getElementsByClassName('otevrit')[0];
const zavritMobilniNavigaci = document.getElementsByClassName('zavrit')[0];

otevritMobilniNavigaci.addEventListener('click', () => {
    odkazyNavigace.classList.add('otevreno');
    otevritMobilniNavigaci.classList.add('otevreno');
    zavritMobilniNavigaci.classList.add('otevreno');
});

zavritMobilniNavigaci.addEventListener('click', () => {
    odkazyNavigace.classList.remove('otevreno');
    otevritMobilniNavigaci.classList.remove('otevreno');
    zavritMobilniNavigaci.classList.remove('otevreno');
});


/*
Zobrazit dialogové okno:
- po kliknutí na nejaký element se dialog otevře
- po kliknutí na nějaký element se dialog zavře (tlačítko, ikona - křížek, apod.)
- po kliknutí na backdrop se dialog zavře

- identifikace elemnetů pro otevření/zavření bude realizována pomocí atributového (CSS) selektoru
- dialog indentifikujeme pomocí ID atributu
- element, který bude otevírat/zavírat dialog bude uloženo ID dialogu v data atributu


HTML:
<button data-otevri-dialog="info">Otevři dialog</button>

<dialog id="info">
    <!-- div je potřeba pro správnou funkcionalitu zavření při kliknutí do backdropu -->
    <div class="obsah-dialogu">
        text zprávy
        <button data-zavri-dialog="info">Zavri dialog</button>
    </div>        
</dialog>
*/

const otevriDialog = document.querySelectorAll("[data-otevri-dialog]");
const zavriDialog = document.querySelectorAll("[data-zavri-dialog]");
const dialogy = document.getElementsByTagName('dialog');

/* vytvoření posluchačů událostí pro otevření - libovolný počet */
for (let i = 0; i < otevriDialog.length; i++) {
    otevriDialog[i].addEventListener('click', (event) => {
        const dialogId = event.target.dataset.otevriDialog;
        document.getElementById(dialogId).showModal();
    });
}

/* vytvoření posluchačů událostí pro zavření - libovolný počet */
for (let i = 0; i < zavriDialog.length; i++) {
    zavriDialog[i].addEventListener('click', (event) => {
        const dialogId = event.target.dataset.zavriDialog;
        document.getElementById(dialogId).close();
    });
}

/* vytvoření posluchačů událostí pro zavření při kliknutí do backdropu - nutné i nastavení v CSS */
for (let i = 0; i < dialogy.length; i++) {
    dialogy[i].addEventListener('click', (event) => {
        if (event.target === event.currentTarget) {
            event.target.close();
        }
    });
}


/*
Informační zpráva - například (ne)úspěšné odeslání formuláře apod.

- zobrazí se fixně v pravém spodní rohu (CSS) - zprávu budeme přidávat přes BE
- po nějaké době (5s) sama zmizí (JS)

- identifikace zprávy podle ID atributu

HTML:
<div id="zprava">
    <div class="typ-zpravy uspech"></div>
    <p>Text zprávy.</p>
</div>
*/

const zprava = document.getElementById('zprava');

if (zprava) {
    setTimeout(() => {
        zprava.remove();
    }, 5000);
}

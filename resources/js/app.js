// Импортируем Bootstrap JS (чтобы работали data-bs-toggle, модалки и т.д.)
import * as bootstrap from "bootstrap";

window.bootstrap = bootstrap;

// ЛОГ, чтобы проверить, что файл вообще подхватился
console.log("app.js загружен");

// === МОДАЛКА 'ПОДРОБНЕЕ' С ПЕРЕКЛЮЧЕНИЕМ КАРТОЧЕК ===

document.addEventListener("DOMContentLoaded", () => {
    const figureModalEl = document.getElementById("figureModal");
    if (!figureModalEl) {
        console.warn("figureModal не найден");
        return;
    }

    const modalInstance = bootstrap.Modal.getOrCreateInstance(figureModalEl);

    const detailButtons = Array.from(document.querySelectorAll(".js-figure-details"));
    let currentIndex = 0;

    const titleEl    = figureModalEl.querySelector(".js-figure-title");
    const imgEl      = figureModalEl.querySelector(".js-figure-image");
    const descEl     = figureModalEl.querySelector(".js-figure-description");
    const typeEl     = figureModalEl.querySelector(".js-figure-type");
    const heightEl   = figureModalEl.querySelector(".js-figure-height");
    const materialEl = figureModalEl.querySelector(".js-figure-material");
    const releaseEl  = figureModalEl.querySelector(".js-figure-release");

    const prevBtn = figureModalEl.querySelector(".js-figure-prev");
    const nextBtn = figureModalEl.querySelector(".js-figure-next");

    function fillModalFromButton(btn) {
        if (!btn) return;

        const name        = btn.dataset.figureName || "";
        const image       = btn.dataset.figureImage || "/images/placeholder.png";
        const type        = btn.dataset.figureType || "";
        const height      = btn.dataset.figureHeight || "";
        const material    = btn.dataset.figureMaterial || "";
        const release     = btn.dataset.figureRelease || "";
        const description = btn.dataset.figureDescription || "";

        titleEl.textContent = name || "Детали фигурки";
        imgEl.src           = image;
        imgEl.alt           = name;

        descEl.textContent  = description || "Подробное описание пока не добавлено.";

        typeEl.textContent =
            type ? `Тип: ${type}` : "";

        heightEl.textContent =
            height ? `Высота: ${height} см` : "";

        materialEl.textContent =
            material ? `Материал: ${material}` : "";

        releaseEl.textContent =
            release ? `Дата выхода: ${release}` : "";
    }

    function showByIndex(index) {
        if (!detailButtons.length) return;

        const len = detailButtons.length;

        // НОРМАЛИЗУЕМ индекс в диапазон [0, len-1] (циклично)
        const normalized = ((index % len) + len) % len;

        currentIndex = normalized;
        fillModalFromButton(detailButtons[currentIndex]);
    }

    // Когда модалка открывается (клик по "Подробнее")
    figureModalEl.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget;
        if (!button) return;

        const idx = detailButtons.indexOf(button);
        currentIndex = idx !== -1 ? idx : 0;

        fillModalFromButton(button);
    });

    // Кнопка "предыдущая" (с первой → на последнюю)
    prevBtn?.addEventListener("click", () => {
        showByIndex(currentIndex - 1);
    });

    // Кнопка "следующая" (с последней → на первую)
    nextBtn?.addEventListener("click", () => {
        showByIndex(currentIndex + 1);
    });

    // Стрелки на клавиатуре при открытой модалке (тоже циклично)
    document.addEventListener("keydown", (e) => {
        if (!figureModalEl.classList.contains("show")) return;

        if (e.key === "ArrowLeft") {
            e.preventDefault();
            showByIndex(currentIndex - 1);
        }

        if (e.key === "ArrowRight") {
            e.preventDefault();
            showByIndex(currentIndex + 1);
        }
    });

    console.log("Модалка Подробнее инициализирована");
});


// === МОДАЛКА УДАЛЕНИЯ ===

document.addEventListener("DOMContentLoaded", () => {
    const deleteModalEl = document.getElementById("deleteModal");
    const deleteForm    = document.getElementById("deleteForm");

    if (!deleteModalEl || !deleteForm) {
        console.warn("deleteModal или deleteForm не найдены");
        return;
    }

    deleteModalEl.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget;
        if (!button) return;

        const route = button.dataset.route;
        deleteForm.action = route;
    });

    console.log("Модалка удаления инициализирована");
});

document.addEventListener("DOMContentLoaded", () => {
    // КНОПКА "ЗАГРУЗИТЬ" + TOAST
    const downloadBtn     = document.getElementById("downloadBtn");
    const downloadToastEl = document.getElementById("downloadToast");

    if (downloadBtn && downloadToastEl) {
        const downloadToast = new bootstrap.Toast(downloadToastEl, {
            delay: 3000,   // сколько висит тост
            autohide: true // автоматически скрывается
        });

        downloadBtn.addEventListener("click", (e) => {
            e.preventDefault(); // чтобы страница не дергалась по #
            downloadToast.show();
        });
    }

    // TOAST ДЛЯ УСПЕШНЫХ ОПЕРАЦИЙ (add / edit / delete)
    const successToastEl = document.getElementById("successToast");

    if (successToastEl) {
        const successToast = new bootstrap.Toast(successToastEl, {
            delay: 3000,
            autohide: true
        });

        // сразу показываем, если Laravel положил в сессию `success`
        successToast.show();
    }
});

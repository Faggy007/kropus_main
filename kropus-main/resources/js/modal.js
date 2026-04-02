function openModal(id) {
    closeModal();
    if (!id.startsWith("#")) {
        id = "#" + id;
    }
    const modal = document.querySelectorAll(id);
    if (modal.length > 0) {
        modal.forEach((el) => {
            console.log(el);
            el.classList.add("--active");
        });
        clipBody();
    }
}

function closeModal() {
    const modals = document.querySelectorAll(".modal");
    modals.forEach((modal) => {
        modal.classList.remove("--active");
    });
    unclipBody();
}

function clipBody() {
    document.body.classList.add("is-clipped");
}

function unclipBody() {
    document.body.classList.remove("is-clipped");
}

window.openModal = openModal;
window.closeModal = closeModal;
window.clipBody = clipBody;
window.unclipBody = unclipBody;

export { openModal, closeModal, clipBody, unclipBody };

"use strict";
class Main {

    constructor( vueJS ) {
        this.gameModalClose = this.gameModalClose.bind(this);
        this.gameDeleteConfirm = this.gameDeleteConfirm.bind(this);
        this.gameModalConfirm = this.gameModalConfirm.bind(this);

        this.webServiceURLGameDelete = "./cors/functions/delete_request.php";
        this.modalTemplateElement = null;
        this.gameModalElement = null;
        this.gameFormElement = null;
        this.vueJS = vueJS;
        this.init();
    }

    init() { 
        this.modalManager();
        this.gameMainTableFixWidthScrollbar();
        //console.log(this.vueJS);
    }

    /*
     * to fix position of table head elements and table body elements avoiding offset width of scrollbar in table_body
     */
    gameMainTableFixWidthScrollbar() {
        var table_header_width = document.getElementsByClassName("table_header")[0].offsetWidth;
        var table_body_width = document.getElementsByClassName("table_body")[0].offsetWidth;
        var scrollbar_width_fixer = document.getElementsByClassName("scrollbar_width_fixer")[0];
        scrollbar_width_fixer.style.width = table_header_width - table_body_width + "px";
    }

    modalManager() {
        this.modalTemplateElement = document.querySelector("[data-template='modal']");
        this.gameFormElement = document.getElementById("game-form");
        var gameDeleteButton = document.getElementsByClassName("delete")[0];
        gameDeleteButton.addEventListener("click", this.gameDeleteConfirm);
    }

    gameDeleteConfirm(event) {
        event.preventDefault();
        this.gameModalElement = this.modalTemplateElement.cloneNode(true);
        this.gameModalElement.removeAttribute("data-template");
        this.modalTemplateElement.parentElement.insertBefore(this.gameModalElement, this.modalTemplateElement);
        let closableElement = this.gameModalElement.querySelectorAll("[data-action='close-modal']");
        let confirmableElement = this.gameModalElement.querySelectorAll("[data-action='confirm-modal']");
        closableElement.forEach((elem) => {
            elem.addEventListener("click", this.gameModalClose);
        });
        confirmableElement.forEach((elem) => {
            elem.addEventListener("click", this.gameModalConfirm);
        });
    }

    gameModalClose() {
        this.gameModalElement.parentElement.removeChild(this.gameModalElement);
    }

    
    setGameModalWaiting() {
        this.gameModalElement.style.pointerEvents = "none"
        this.gameModalElement.style.opacity = "0.8";
    }

    gameModalConfirm() {
        //this.setGameModalWaiting();
        let gameFormData = this.getGameFormData();
        var xhr = new XMLHttpRequest();
        xhr.open("POST", this.webServiceURLGameDelete, true);
        xhr.setRequestHeader("Content-Type", "application/json");
        this.gameModalClose();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                console.log(response);
                if (response.status) {
                    this.vueJS.updateDatas(() => {
                        this.unCheckCheckedGameFormData();
                    });
                }
            }
        };

        xhr.send(JSON.stringify(gameFormData));
    }

    getGameFormData() {
        let checkedElements = this.gameFormElement.querySelectorAll(".checkbox:checked");
        let values = [];
        checkedElements.forEach((elem) => {
            values.push(JSON.parse(elem.value));
        });

        return values;
    }

    unCheckCheckedGameFormData() {
        let checkedElements = this.gameFormElement.querySelectorAll(".checkbox:checked");
        let values = [];
        checkedElements.forEach((elem) => {
            elem.checked = false;
        });

        return values;
    }
}


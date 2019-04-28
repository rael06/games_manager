"use strict";

window.onload = function () {
    /*
    var request = new XMLHttpRequest();
    request.open("GET", "cors/json_manager.php");
    request.addEventListener("load", (event) => {
        console.log(JSON.parse(event.target));
    })
    request.send();
    */

    var containedSearched = function(searched, _element) {
        return Object.values(_element).find(value => {
            if (value !== null) {
                return value.toLowerCase().includes(searched.toLowerCase())
            }
        })
    }
    
    /*
    var containedSearched = function (searched, _element) {
        var result = false;
        Object.values(_element).forEach(value => {
            if (value !== null) {
                if (value.toLowerCase().includes(searched.toLowerCase())) {
                    result = true;
                }
            }
        })
        return result;
    }
    */
    
    /*
    var containedSearched = function (searched, _element) {
        var result = false;
        for (let i = 0; i < Object.values(_element).length; i++) {
            if (Object.values(_element)[i] !== null) {
                if (Object.values(_element)[i].toLowerCase().includes(searched.toLowerCase())) {
                    result = true;
                }
            }
        }
        return result;
    }
    */

    function initVueJS(datasServer) {
        var vueJS = new Vue({
            el: "#content",
            data: {
                datas: datasServer,
                search: ""
            },
            computed: {
                filtered: function () {	//filter function
                    return this.datas.filter(element => containedSearched(this.search, element))
                }/*,
                searches: function () {	//filter function
                    return this.search.split(" ");
                }*/
            },
            mounted: function() {
                let main = new Main(this);
                document.querySelector(".spinner-container").classList.toggle("hide");
                document.querySelector(".div_to_scroll").classList.toggle("undisplay");
                // infinite progress here *************************************************************************************************
            },
            methods: {
                updateDatas: function (callBack) {
                    document.querySelector(".spinner-container").classList.toggle("hide");
                    getDataServer((dataServer) => {
                        callBack();
                        document.querySelector(".spinner-container").classList.toggle("hide");
                        this.datas = dataServer;
                    });
                }
            }
        })
    }

    function getDataServer(callBack) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(event) {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                callBack(JSON.parse(this.responseText));
            }
        };

        xhr.open('GET', './cors/functions/request.php', true);
        xhr.send(null);
    }

    getDataServer(initVueJS);
}

//faire une fonction pour rechercher en fonction des split " "

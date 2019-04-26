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

    var datasVue = new Vue({
        el: "#content",
        data: {
            datas: datas,
            search: ""
        },
        computed: {
            filtered: function () {	//filter function
                return this.datas.filter(element => containedSearched(this.search, element))
            }/*,
            searches: function () {	//filter function
                return this.search.split(" ");
            }*/
        }
    })
}

//faire une fonction pour rechercher en fonction des split " "
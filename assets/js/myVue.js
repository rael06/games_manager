"use strict";

window.onload = function () {
    function dateConverter(date) {
        let convertedDate = [];
        if (date === null) {
            return null;
        }
        let dateArray = date.split(" ");
        let day = "01";
        let month = "01";
        let year = null;
        for (let i = 0; i < dateArray.length; i++) {
            if (dateArray[i].length < 4 && dateArray[i] !== null) {
                day = dateArray[i];
            } else if (isNaN(dateArray[i]) && dateArray[i] !== null) {
                month = dateArray[i];
                switch (month) {
                    case "January":
                        month = "01";
                        break;
                    case "February":
                        month = "02";
                        break;
                    case "March":
                        month = "03";
                        break;
                    case "April":
                        month = "04";
                        break;
                    case "May":
                        month = "05";
                        break;
                    case "June":
                        month = "06";
                        break;
                    case "July":
                        month = "07";
                        break;
                    case "August":
                        month = "08";
                        break;
                    case "September":
                        month = "09";
                        break;
                    case "October":
                        month = "10";
                        break;
                    case "November":
                        month = "11";
                        break;
                    default:
                        month = "12";
                }
            } else if (dateArray[i] !== null) {
                year = dateArray[i];
            }
        }
        if (year === null) {
            return null;
        }

        convertedDate = [month, day, year].join(" ").trim();
        
        return new Date(convertedDate);
    }
    
    function sortedDatas(datasToSort, event) {
        let by = event.target.getAttribute("value");
        
        datasToSort.sort((next, current) => {
            if (by === "ReleaseDate") {
                var nextGame = dateConverter(next[by]);
                var currentGame = dateConverter(current[by]);    
            } else if (by === "ID") {
                var nextGame = parseInt(next[by]);
                var currentGame = parseInt(current[by]);
            } else {
                var nextGame = next[by];
                var currentGame = current[by];
            }
            
            if (nextGame < currentGame) {
                return -1;
            } else if (nextGame > currentGame) {
                return 1;
            }
            return 0;
        });
        return datasToSort;
    }

    var containedSearched = function(searched, _element) {
        return Object.values(_element).find(value => {
            if (value !== null) {
                return value.toLowerCase().includes(searched.toLowerCase())
            }
        })
    }

    /*
    var request = new XMLHttpRequest();
    request.open("GET", "cors/json_manager.php");
    request.addEventListener("load", (event) => {
        console.log(JSON.parse(event.target));
    })
    request.send();
    */
    
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
                search: "",
                datasSorted: []
            },
            computed: {
                filtered: function () {	//filter function
                    return this.datas.filter(element => containedSearched(this.search, element));
                }/*,
                searches: function () {	//filter function
                    return this.search.split(" ");
                }*/
            },
            mounted: function() {
                let main = new Main(this);
                console.log(this);
                
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
                },
                sort: function () {
                    this.datasSorted = sortedDatas(this.datas, event);
                    //console.log(event);
                }/*,
                splitOnSpaceBar: function (event) {
                    let key = event.which;
                    console.log(key);
                    
                        if (key = 32) {
                            this.search = this.search.split(" ");
                            console.log(this.search);
                            
                        }
                    }
                */
                
                /*
                ,
                sortedGameDatabase: function () {	//sorted database
                    var useSplitReverse = true;
                    (this.by === "name")? useSplitReverse = true : useSplitReverse = false;
                    return sorter(database, 1, this.by, useSplitReverse)
                }*/
                // need on keydown (space bar) split this.search
            }
        })
    }

    function getDataServer(callBack) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(event) {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                callBack(JSON.parse(this.responseText));
                //console.log(this.responseText);
                
            }
        };

        xhr.open('GET', './cors/functions/json_manager.php', true);
        xhr.send(null);
    }

    getDataServer(initVueJS);
}



//faire une fonction pour rechercher en fonction des split " "

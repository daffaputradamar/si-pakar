$(document).ready(function() {
    getDataToCalculate((data) => {
        const grouppedData = groupGejalaByPenyakit(data)
        $(document).on("click", "#btnhitung", () => {   
            const result = calculate(grouppedData)
            renderTable(result)
        })
    })
})

function calculate(data) {
    const cfCombine = Object.keys(data).reduce((acc, curr) => {
        acc[curr] = calculatePerPenyakit(data[curr])
        return acc
    }, {})

    const keysSorted = Object.keys(cfCombine).sort(function(a,b){return cfCombine[b]-cfCombine[a]}).slice(0, 3)
    const returnObj = keysSorted.map(val => {
        return {
            penyakit: val,
            cfCombine: cfCombine[val].toFixed(2)
        }
    })

    return returnObj
}

function calculatePerPenyakit(data) {
    const cfHE = data.map(val => Number(val["nilaipakar"]) * Number(val["nilaiuser"]))

    let cfCombine = cfHE.reduce((acc, curr, idx) => {
        acc = acc + curr * (1 - acc)
        return acc
    })

    cfCombine = cfCombine * 100

    return cfCombine
}

function renderTable(data) {
    $("#containerdiagnosa").removeClass("d-none")
    const tableBody = $("#tbldiagnosa")

    data.forEach((item, idx) => {
        tableBody.append($("<tr>").append(
        $("<td>").append((idx + 1)), 
        $("<td>").append(item["penyakit"]), 
        $("<td>").append(item["cfCombine"])
        ))
    })

}

function groupGejalaByPenyakit(data) {
    return data.reduce((acc, curr) => {
        acc[curr['penyakit']] = (!acc[curr['penyakit']]) ? [curr] : [...acc[curr['penyakit']], curr]
        return acc
    }, {})
    
}

function getDataToCalculate(callback) {
    $.ajax({
        type: "GET",
        url: "/api/get_data_to_calculate.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            callback(result)
        },
        error: function (result) {
            console.log(result);
        }
    });
}
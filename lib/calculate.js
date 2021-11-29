const hierarchy = ["Rendah", "Sedang", "Tinggi"]

$(document).ready(function () {
    fuzzyrule()
    console.log(fuzzification(0.3));
    console.log(fuzzification(0.7));
    $(document).on("click", "#btnhitung", () => {
        getDataToCalculate((data) => {
            const grouppedData = groupGejalaByPenyakit(data)
            const resultCF = calculateCF(grouppedData)
            calculateFuzzy(grouppedData)
            renderTable(resultCF)
        })
    })
})

function calculateCF(data) {
    const cfCombine = Object.keys(data).reduce((acc, curr) => {
        acc[curr] = calculateCFPerPenyakit(data[curr])
        return acc
    }, {})

    const keysSorted = Object.keys(cfCombine).sort(function (a, b) { return cfCombine[b] - cfCombine[a] }).slice(0, 3)
    const returnObj = keysSorted.map(val => {
        return {
            penyakit: val,
            cfCombine: cfCombine[val].toFixed(2)
        }
    })

    return returnObj
}

function calculateFuzzy(data) {
    // const fuzzy = Object.keys(data).reduce((acc, curr) => {
    //     acc[curr] = calculateFuzzyPerPenyakit(data[curr])
    //     return acc
    // }, {})

    const curr = Object.keys(data)[0]
    const fuzzy = calculateFuzzyPerPenyakit(data[curr])

    return fuzzy
}

function calculateCFPerPenyakit(data) {
    const cfHE = data.map(val => Number(val["nilaipakar"]) * Number(val["nilaiuser"]))

    let cfCombine = cfHE.reduce((acc, curr, idx) => {
        acc = acc + curr * (1 - acc)
        return acc
    })

    cfCombine = cfCombine * 100

    return cfCombine
}

function calculateFuzzyPerPenyakit(data) {
    const fuzzyfikasi = data.map((obj) => {
        console.log(fuzzification(obj.nilaipakar), fuzzification(obj.nilaiuser));
        return {
            nilaipakar: obj.nilaipakar,
            nilaiuser: obj.nilaiuser,
            nilaiFuzzy: calculateFuzzyPerGejala(obj.gejala, fuzzification(obj.nilaipakar), fuzzification(obj.nilaiuser))
        }
    })

    defuzzifikasi(fuzzyfikasi)
}

function defuzzifikasi(data) {
    const defuzzifikasiPenyakit = data.map(item => {
        return defuzzyfikasiPerGejala(item)
    })

    defuzzyfikasiPerGejala

    console.log("def", defuzzifikasiPenyakit);
}

function defuzzyfikasiPerGejala(data) {
    const grouppedFuzzy = data['nilaiFuzzy'].reduce((acc, curr) => {
        acc[curr['out']] = (!acc[curr['out']]) ? [curr] : [...acc[curr['out']], curr]
        return acc
    }, {})

    const maxZ = Object.keys(grouppedFuzzy).map(key => {
        const maxZPerGroup = grouppedFuzzy[key].reduce((max, obj) => (max.inferensi > obj.inferensi) ? max : obj);
        return maxZPerGroup
    })

    const zVal = maxZ.reduce((max, obj) => (obj.inferensi != 0 && (max.inferensi < obj.inferensi)) ? obj : max).out

    const _data = {
        ...data,
        "nilaiFuzzy": zVal
    }
    return _data
}

function calculateFuzzyPerGejala(gejala, pakar, user) {
    const rules = fuzzyrule()

    const inferensi = rules.map(rule => {
        return {
            gejala,
            out: rule.fuzzyOut,
            z: rule.z,
            inferensi: Math.min(pakar[rule.typePakar], user[rule.typeUser])
        }
    })

    const groupByOut = inferensi.reduce((acc, curr) => {
        acc[curr['out']] = !(acc[curr['out']]) ? [curr] : [...acc[curr['out']], curr]
        return acc
    }, {})

    console.log(groupByOut);
    return inferensi
}

function renderTable(data) {
    $("#containerdiagnosa").removeClass("d-none")
    const tableBody = $("#tbldiagnosa")
    tableBody.empty()

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
        url: "/si-pakar/api/get_data_to_calculate.php",
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

function fuzzyrule() {
    const origRules = [
        { typePakar: "Rendah", valPakar: 0.1, typeUser: "Rendah", valUser: 0.1, fuzzyOut: "Rendah" },
        { typePakar: "Rendah", valPakar: 0.1, typeUser: "Sedang", valUser: 0.3, fuzzyOut: "Rendah" },
        { typePakar: "Rendah", valPakar: 0.1, typeUser: "Tinggi", valUser: 0.5, fuzzyOut: "Sedang" },
        { typePakar: "Sedang", valPakar: 0.3, typeUser: "Rendah", valUser: 0.1, fuzzyOut: "Rendah" },
        { typePakar: "Sedang", valPakar: 0.3, typeUser: "Sedang", valUser: 0.3, fuzzyOut: "Sedang" },
        { typePakar: "Sedang", valPakar: 0.3, typeUser: "Tinggi", valUser: 0.5, fuzzyOut: "Tinggi" },
        { typePakar: "Tinggi", valPakar: 0.5, typeUser: "Rendah", valUser: 0.1, fuzzyOut: "Sedang" },
        { typePakar: "Tinggi", valPakar: 0.5, typeUser: "Sedang", valUser: 0.3, fuzzyOut: "Tinggi" },
        { typePakar: "Tinggi", valPakar: 0.5, typeUser: "Tinggi", valUser: 0.5, fuzzyOut: "Tinggi" },
    ]
    const rules = origRules.map(val => {
        return { ...val, z: (val.valPakar + val.valUser) }
    })
    return rules
}

function fuzzification(val) {
    const Rendah = (val <= 0.2) ? 1 : (val < 1) ? ((1 - val) / 1 - 0.2) : 0
    const Sedang = (val <= 0.2 || val >= 1) ? 0 : (val > 0.2 && val < 0.6) ? ((val - 0.2) / 0.6 - 0.2) : (val > 0.6 && val < 1) ? ((1 - val) / 1 - 0.6) : 1
    const Tinggi = (val <= 0.2) ? 0 : (val < 1) ? ((val - 0.2) / 1 - 0.2) : 1
    return { Rendah, Sedang, Tinggi }
}
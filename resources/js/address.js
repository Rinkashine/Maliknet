import PHAddress from './ph-address/ph-address';

const address = new PHAddress()

const populateSelect = (collection=[],select, key)=>{
    clearSelect(select)
    collection.forEach(data=>{
         const option = new Option(data[key], data[key])
         select.appendChild(option)
     })
 }
 const clearSelect = (select)=>{
    Array.from(select.children).forEach((c, i)=>{
        if(i != 0){
            c.remove()
        }
    })
 }
window.addEventListener("load", ()=>{
    const provinceSelect = document.querySelector("#Province")
    const citySelect = document.querySelector("#City")
    const barangaySelect = document.querySelector("#Barangay")

     populateSelect(address.findProvinces(),provinceSelect, "name")
    if(window.MODE == "EDIT"){
        const province  = window.address.province;
        const city = window.address.city;
        const brgy = window.address.brgy;

        provinceSelect.value = province
        populateSelect(address.findCitiesByProvinceName(province), citySelect, "name")
        citySelect.value = city
        populateSelect(address.findBarangaysByCityName(city), barangaySelect, "name")
        barangaySelect.value = brgy

    }
    provinceSelect.addEventListener('change', (event)=>{
            const value = event.target.value
            citySelect.selectedIndex = 0
            clearSelect(citySelect)
            barangaySelect.selectedIndex = 0
            clearSelect(barangaySelect)
            populateSelect(address.findCitiesByProvinceName(value), citySelect, "name")
        })
    citySelect.addEventListener('change', (event)=>{
        const value = event.target.value
        barangaySelect.selectedIndex = 0
        clearSelect(barangaySelect)
        populateSelect(address.findBarangaysByCityName(value), barangaySelect, "name")
    })

})


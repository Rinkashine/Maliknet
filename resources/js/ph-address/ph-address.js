const regions = require("./data/regions.json");
const provinces = require("./data/provinces.json");
const districts = require("./data/districts.json");
const citiesMunicipalities = require("./data/cities-municipalities.json");
const barangays = require("./data/barangays.json");
const subMunicipalities = require("./data/sub-municipalities.json");

class PHAddress {

    findRegions(){
        return regions
    }
    findRegionByCode(regionCode) {
        const region = regions.find((region) => region.code === regionCode);
        return region;
    }
    findRegionByRegionName(regionName) {
        const region = regions.find((region) => region.regionName === regionName);
        return region;
    }
    findProvinces(){
        let provinces = []
        regions.forEach((r)=>{
            provinces = provinces.concat(this.findProvincesByRegionCode(r.code))
        })
        return provinces
    }
    findProvincesByRegionCode(regionCode) {
        const filteredProvinces = provinces.filter(
            (province) => province.regionCode === regionCode
        );
        const filteredDistricts = districts.filter(
            (district) => district.regionCode === regionCode
        );
        const filteredCitiesLikeProvince = citiesMunicipalities.filter(
            (cm) => cm.regionCode === regionCode && !cm.provinceCode && !cm.districtCode
        );
        return filteredProvinces
            .concat(filteredDistricts)
            .concat(filteredCitiesLikeProvince);
    }
    findProvincesByRegionName(regionName) {
        const region = this.findRegionByRegionName(regionName);
        return this.findCityByNamefindProvincesByRegionCode(region?.code);
    }
    findProvinceByProvinceCode(provinceCode) {
        let province = provinces.find((province) => province.code === provinceCode);
        if (!province) {
            province = districts.find((district) => district.code === provinceCode);
        }
        return province;
    }
    findProvinceByName(provinceName) {
        let province = provinces.find((province) => province.name === provinceName);
        if (!province) {
            province = districts.find((district) => district.name === provinceName);
        }
        if (!province) {
            province = citiesMunicipalities.find(
                (city) => city.name === provinceName && !city.provinceCode
            );
        }
        return province;
    }

    findCitiesByProvinceCode(provinceCode) {
        const filteredCities = citiesMunicipalities.filter((city) => {
            if (
                city.provinceCode === provinceCode ||
                city.districtCode === provinceCode
            ) {
                return city;
            }
            if (city.code === provinceCode && !city.provinceCode) {
                return city;
            }
        });
        const filteredSubMunicipalities = subMunicipalities.filter((subM) => {
            if (
                subM.districtCode === provinceCode ||
                subM.provinceCode === provinceCode
            ) {
                return subM;
            }
        });
        return filteredCities.concat(filteredSubMunicipalities);
    }
    findCitiesByProvinceName(provinceName) {
        const province = this.findProvinceByName(provinceName);
        return this.findCitiesByProvinceCode(province?.code);
    }
    findCityByName(cityName) {
        let city = citiesMunicipalities.find((cm) => cm.name === cityName);
        if (!city) {
            city = subMunicipalities.find((subM) => subM.name === cityName);
        }
        return city;
    }
    findBarangaysByCityCode(cityCode) {
        const filteredBarangays = barangays.filter(
            (barangay) =>
                barangay.cityCode === cityCode ||
                barangay.municipalityCode === cityCode ||
                barangay.provinceCode === cityCode
        );
        return filteredBarangays;
    }
    findBarangaysByCityName(cityName) {
        const city = this.findCityByName(cityName);
        return this.findBarangaysByCityCode(city?.code);
    }
}


export default PHAddress



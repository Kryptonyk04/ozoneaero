document.addEventListener("DOMContentLoaded", () => {
    const countyPaths = document.querySelectorAll("#features path")
    const countyInfo = document.getElementById("county-info")
    const weatherDetails = document.getElementById("weather-details")
    const timePeriodSelector = document.getElementById("time-period-selector")
    const timeButtons = document.querySelectorAll(".time-btn")
    const loadingIndicator = document.getElementById("loading-indicator")
  
    let selectedCountyId = null
    let selectedTimePeriod = "daily"
    let weatherData = null
  
    const countyLocations = {
      ROSM: "Satu Mare, Romania",
      ROAR: "Arad, Romania",
      ROBH: "Oradea, Romania", 
      ROTM: "Timisoara, Romania",
      ROMH: "Drobeta-Turnu Severin, Romania",
      RODJ: "Craiova, Romania",
      ROCL: "Calarasi, Romania",
      ROTR: "Alexandria, Romania",
      ROGR: "Giurgiu, Romania",
      ROCT: "Constanta, Romania",
      ROOT: "Slatina, Romania",
      ROCS: "Resita, Romania",
      ROBT: "Botosani, Romania",
      ROIS: "Iasi, Romania",
      ROVS: "Vaslui, Romania",
      ROGL: "Galati, Romania",
      ROSV: "Suceava, Romania",
      ROMM: "Baia Mare, Romania",
      ROTL: "Tulcea, Romania",
      ROCJ: "Cluj-Napoca, Romania",
      ROBN: "Bistrita, Romania",
      ROSJ: "Zalau, Romania",
      RODB: "Targoviste, Romania",
      ROIF: "Buftea, Romania",
      ROAG: "Pitesti, Romania",
      ROGJ: "Targu Jiu, Romania",
      ROHD: "Deva, Romania", 
      ROVL: "Ramnicu Valcea, Romania",
      ROPH: "Ploiesti, Romania", 
      ROCV: "Sfantu Gheorghe, Romania",
      ROVN: "Focsani, Romania",
      ROBZ: "Buzau, Romania",
      ROBV: "Brasov, Romania",
      ROSB: "Sibiu, Romania",
      ROMS: "Targu Mures, Romania",
      ROHR: "Miercurea Ciuc, Romania",
      RONT: "Piatra Neamt, Romania",
      ROBC: "Bacau, Romania",
      ROAB: "Alba Iulia, Romania",
      ROBR: "Braila, Romania",
      ROIL: "Slobozia, Romania",
      ROB: "Bucharest, Romania",
    }
  
    countyPaths.forEach((path) => {
      path.addEventListener("click", function () {
        countyPaths.forEach((p) => p.classList.remove("active"))

        this.classList.add("active")
  
        selectedCountyId = this.id
  
        loadingIndicator.style.display = "flex"
        weatherDetails.style.display = "none"
        timePeriodSelector.style.display = "none"
  
        const location = countyLocations[selectedCountyId] || "Bucharest, Romania"
  
        fetchWeatherData(location)
          .then((data) => {
            weatherData = data
  
            timePeriodSelector.style.display = "flex"
  
            updateWeatherDisplay()
  
            const currentTemp = weatherData.current.temp_c
            const currentCondition = weatherData.current.condition.text
            colorCountyByWeather(selectedCountyId, currentCondition, currentTemp)
  
            if (weatherData._fallback) {
              weatherDetails.insertAdjacentHTML(
                "afterbegin",
                `
                <div class="fallback-notice">
                  <p>Note: Using estimated weather data. Live data is currently unavailable.</p>
                </div>
              `,
              )
            }
          })
          .catch((error) => {
            console.error("Error fetching weather data:", error)
            weatherDetails.innerHTML = `
              <div class="error-message">
                <p>Sorry, we couldn't load the weather data. Please try again later.</p>
                <p>Error: ${error.message}</p>
                <p>If this problem persists, please <a href="api/debug-weather.php" target="_blank">run the diagnostic tool</a> to help troubleshoot.</p>
              </div>
            `
          })
          .finally(() => {
            loadingIndicator.style.display = "none"
            weatherDetails.style.display = "block"
          })
      })
    })
  
    timeButtons.forEach((button) => {
      button.addEventListener("click", function () {
        timeButtons.forEach((btn) => btn.classList.remove("active"))
  
        this.classList.add("active")
  
        selectedTimePeriod = this.dataset.period
  
        updateWeatherDisplay()
      })
    })
  
    async function fetchWeatherData(location) {
      try {
        const response = await fetch(`weather.php?location=${encodeURIComponent(location)}&days=7`)

        const data = await response.json()
  
        if (data.error) {
          throw new Error(data.error)
        }
  
        return data
      } catch (error) {
        console.error("Error fetching weather data:", error)
        throw error
      }
    }
  
    function updateWeatherDisplay() {
      if (!weatherData || !selectedCountyId) return
  
      const county = countyLocations[selectedCountyId].split(",")[0]
  
      countyInfo.innerHTML = `
        <h2>${county}</h2>
        <p>Weather forecast for ${county}.</p>
      `
      switch (selectedTimePeriod) {
        case "daily":
          displayDailyForecast(weatherData)
          break
        case "hourly":
          displayHourlyForecast(weatherData)
          break
        case "weekly":
          displayWeeklyForecast(weatherData)
          break
      }
  
      if (weatherData._fallback) {
        weatherDetails.insertAdjacentHTML(
          "afterbegin",
          `
          <div class="fallback-notice">
            <p>Note: Using estimated weather data. Live data is currently unavailable.</p>
          </div>
        `,
        )
      }
    }
  
    function displayDailyForecast(data) {
      const current = data.current
      const condition = current.condition
  
      const iconUrl = condition.icon.startsWith("//") ? `https:${condition.icon}` : condition.icon
  
      weatherDetails.innerHTML = `
        <div class="current-temp">${Math.round(current.temp_c)}°C</div>
        <div class="current-condition">
          <img src="${iconUrl}" alt="${condition.text}" class="weather-icon">
          ${condition.text}
        </div>
        <h3>Current Weather</h3>
        <div class="weather-data">
          <div class="weather-item">
            <h4>Feels Like</h4>
            <p>${Math.round(current.feelslike_c)}°C</p>
          </div>
          <div class="weather-item">
            <h4>Humidity</h4>
            <p>${current.humidity}%</p>
          </div>
          <div class="weather-item">
            <h4>Wind</h4>
            <p>${Math.round(current.wind_kph)} km/h</p>
          </div>
          <div class="weather-item">
            <h4>Pressure</h4>
            <p>${Math.round(current.pressure_mb)} hPa</p>
          </div>
          <div class="weather-item">
            <h4>UV Index</h4>
            <p>${current.uv}</p>
          </div>
          <div class="weather-item">
            <h4>Visibility</h4>
            <p>${current.vis_km} km</p>
          </div>
        </div>
      `
    }

    function displayHourlyForecast(data) {
      const forecast = data.forecast.forecastday[0]
      const hours = forecast.hour
      const currentHour = new Date().getHours()
  
      const futureHours = hours.filter((hour) => {
        const hourTime = new Date(hour.time).getHours()
        return hourTime >= currentHour
      })
  
      if (futureHours.length < 7 && data.forecast.forecastday.length > 1) {
        const tomorrowHours = data.forecast.forecastday[1].hour
        const hoursNeeded = 7 - futureHours.length
  
        for (let i = 0; i < hoursNeeded; i++) {
          if (tomorrowHours[i]) {
            futureHours.push(tomorrowHours[i])
          }
        }
      }
  
      const displayHours = futureHours.slice(0, 7)
  
      let hourlyHTML = `
        <h3>Hourly Forecast</h3>
        <div class="hourly-forecast">
      `
  
      displayHours.forEach((hour) => {
        const time = new Date(hour.time)
        const formattedTime = time.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })
  
        const iconUrl = hour.condition.icon.startsWith("//") ? `https:${hour.condition.icon}` : hour.condition.icon
  
        hourlyHTML += `
          <div class="hourly-item">
            <h4>${formattedTime}</h4>
            <img src="${iconUrl}" alt="${hour.condition.text}">
            <p>${Math.round(hour.temp_c)}°C</p>
            <span>${hour.condition.text}</span>
          </div>
        `
      })
  
      hourlyHTML += `</div>`
  
      weatherDetails.innerHTML = hourlyHTML
    }
  
    function displayWeeklyForecast(data) {
      const forecast = data.forecast.forecastday
  
      let weeklyHTML = `
        <h3>7-Day Forecast</h3>
        <div class="weekly-forecast">
      `
  
      forecast.forEach((day) => {
        const date = new Date(day.date)
        const dayName = date.toLocaleDateString(undefined, { weekday: "long" })
  
        const iconUrl = day.day.condition.icon.startsWith("//")
          ? `https:${day.day.condition.icon}`
          : day.day.condition.icon
  
        weeklyHTML += `
          <div class="weekly-item">
            <span class="weekly-day">${dayName}</span>
            <img src="${iconUrl}" alt="${day.day.condition.text}" class="weekly-icon">
            <span class="weekly-condition">${day.day.condition.text}</span>
            <div class="weekly-temp">
              <span class="weekly-high">${Math.round(day.day.maxtemp_c)}°</span>
              <span class="weekly-low">${Math.round(day.day.mintemp_c)}°</span>
            </div>
          </div>
        `
      })
  
      weeklyHTML += `</div>`
  
      weatherDetails.innerHTML = weeklyHTML
    }
  
    function colorCountyByWeather(countyId, condition, temperature) {
      const path = document.getElementById(countyId)
  
      countyPaths.forEach((p) => {
        if (p.id !== countyId) {
          p.style.fill = "#6f9c76"
        }
      })
  
      const conditionLower = condition.toLowerCase()
  
      if (temperature > 30) {
        path.style.fill = "#ef5350" 
      } else if (temperature < 10) {
        path.style.fill = "#90a4ae" 
      } else if (
        conditionLower.includes("rain") ||
        conditionLower.includes("drizzle") ||
        conditionLower.includes("shower")
      ) {
        path.style.fill = "#90caf9" 
      } else if (conditionLower.includes("cloud") || conditionLower.includes("overcast")) {
        path.style.fill = "#e0e0e0" 
      } else if (conditionLower.includes("sun") || conditionLower.includes("clear")) {
        path.style.fill = "#ffeb3b" 
      } else {
        path.style.fill = "#81c784"
      }
    }
  })
  
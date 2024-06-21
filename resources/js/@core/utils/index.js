import axios from "@axios"

// 👉 IsEmpty
export const isEmpty = value => {
  if (value === null || value === undefined || value === '')
    return true
  
  return !!(Array.isArray(value) && value.length === 0)
}

// 👉 IsNullOrUndefined
export const isNullOrUndefined = value => {
  return value === null || value === undefined
}

// 👉 IsEmptyArray
export const isEmptyArray = arr => {
  return Array.isArray(arr) && arr.length === 0
}

// 👉 IsObject
export const isObject = obj => obj !== null && !!obj && typeof obj === 'object' && !Array.isArray(obj)
export const isToday = date => {
  const today = new Date()
  
  return (
    /* eslint-disable operator-linebreak */
    date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear()
  /* eslint-enable */
  )
}

export const pingNAS = () => {
  axios.get('192.168.200.2')
  .then(response => {
    console.log(response)
  }).catch(error => {
    console.log(error)
  })
}

export const convertTo24Hour =  (time) => {
  const [hours, minutes, seconds] = time.split(':')
  return hours % 12 + 12 * (hours % 12 === 0) + ':' + minutes + seconds
}

export const getDateAndTime = () => {
  let date = new Date()
  let year = date.getFullYear()
  let month = date.getMonth() + 1
  let day = date.getDate()
  let hours = date.getHours()
  let minutes = date.getMinutes()
  let seconds = date.getSeconds()

  month = month < 10 ? `0${month}` : month
  day = day < 10 ? `0${day}` : day
  hours = hours < 10 ? `0${hours}` : hours
  minutes = minutes < 10 ? `0${minutes}` : minutes
  seconds = seconds < 10 ? `0${seconds}` : seconds

  return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`
}

export const padZero = (num) => {
  return num < 10 ? `0${num}` : num
}

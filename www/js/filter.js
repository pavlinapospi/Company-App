const input = document.querySelector(".filter-input")
const allOneStaffs = document.querySelectorAll(".one-staff")
const allOneStaffsArray = Array.from(allOneStaffs);
const allStaffsDiv = document.querySelector(".all-staffs")

const staffsObjects = allOneStaffsArray.map( (oneStaff,index) => {
    
    return {
        id: index,
        staffsName: oneStaff.querySelector("h2").textContent,
        staffsLink: oneStaff.querySelector("a")
    }
})

input.addEventListener("input", () => {
    const inputText = input.value.toLowerCase()

    const filteredStaffs = staffsObjects.filter( (oneStaff) => {
        return oneStaff.staffsName.toLowerCase().includes(inputText)
    })

    allStaffsDiv.textContent = ""

    filteredStaffs.map( (oneFilteredStaff) => {
        const newDiv = document.createElement("div")
        newDiv.classList.add("one-staff")

        const newH2 = document.createElement("h2")
        newH2.textContent = oneFilteredStaff.staffsName
        newDiv.append(newH2)

        newDiv.append(oneFilteredStaff.staffsLink)

        allStaffsDiv.append(newDiv)
    })
})

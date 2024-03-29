// TODO : Define a debounce function for auto search
function debounce(func, delay) {
    let timeoutId;
    return function (...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            func(...args);
        }, delay);
    };
}

// TODO : Helper Function for handle pagination
// function generatePaginationControls(data, params) {
//     console.log(params);
//     const paginationNav = document.querySelector(".pagination-nav");
//     paginationNav.innerHTML = ""; // Clear previous controls

//     // Create a list element
//     const paginationList = document.createElement("ul");
//     paginationList.className = "inline-flex -space-x-px text-sm";

//     // Create numbered page buttons
//     data.links.forEach((link) => {
//         const pageItem = createPaginationItem(
//             link.url,
//             link.label,
//             link.active
//         );
//         paginationList.appendChild(pageItem);
//     });

//     // Append the list to the navigation
//     paginationNav.appendChild(paginationList);
// }

// function createPaginationItem(url, label, isActive) {
//     const listItem = document.createElement("li");
//     const linkItem = document.createElement("a");
//     // linkItem.href = url;
//     linkItem.href = "javascript:void(0);";
//     if (label == "&laquo; Previous") {
//         label = "« Previous";
//     } else if (label == "Next &raquo;") {
//         label = "Next »";
//     }
//     linkItem.textContent = label;

//     // Apply the provided styles using template literals
//     linkItem.className = `
//                 flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300
//                 ${
//                     isActive
//                         ? "text-blue-600 bg-blue-50"
//                         : "hover:bg-gray-100 hover:text-gray-700"
//                 }
//                 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 ${
//                     isActive
//                         ? "dark:text-white"
//                         : "dark:hover:bg-gray-700 dark:hover:text-white"
//                 }
//             `;

//     linkItem.addEventListener("click", function (event) {
//         event.preventDefault(); // Prevent the default link behavior

//         // Fetch and update the table data here
//         const pageUrl = url; // Replace 'url' with the correct URL for the page
//         fetchData(null, pageUrl);
//     });

//     listItem.appendChild(linkItem);
//     return listItem;
// }

function generatePaginationControls(data, params) {
    const paginationNav = document.querySelector(".pagination-nav");
    paginationNav.innerHTML = ""; // Clear previous controls

    // Create a list element
    const paginationList = document.createElement("ul");
    paginationList.className = "inline-flex -space-x-px text-sm";

    // Create numbered page buttons
    data.links.forEach((link) => {
        const pageItem = createPaginationItem(
            link.url,
            link.label,
            link.active,
            params // Pass the params object to createPaginationItem
        );
        paginationList.appendChild(pageItem);
    });

    // Append the list to the navigation
    paginationNav.appendChild(paginationList);
}

function createPaginationItem(url, label, isActive, params) {
    const listItem = document.createElement("li");
    const linkItem = document.createElement("a");
    // linkItem.href = url;
    linkItem.href = "javascript:void(0);";
    if (label == "&laquo; Previous") {
        label = "« Previous";
    } else if (label == "Next &raquo;") {
        label = "Next »";
    }
    linkItem.textContent = label;

    // Append search value to the URL
    const urlWithParams = new URL(url, window.location.href);
    if (params) {
        // console.log("ada");
        Object.keys(params).forEach((key) => {
            urlWithParams.searchParams.append(key, params[key]);
        });
    }

    // Apply the provided styles using template literals
    linkItem.className = `
                flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300
                ${
                    isActive
                        ? "text-blue-600 bg-blue-50"
                        : "hover:bg-gray-100 hover:text-gray-700"
                }
                dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 ${
                    isActive
                        ? "dark:text-white"
                        : "dark:hover:bg-gray-700 dark:hover:text-white"
                }
            `;

    linkItem.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent the default link behavior

        // Fetch and update the table data here
        const pageUrl = urlWithParams.toString(); // Use the modified URL with search value
        fetchData(null, pageUrl);
    });

    listItem.appendChild(linkItem);
    return listItem;
}

// TODO : FUNCTION FOR RESET MODAL
function resetModalPosition(modalID) {
    const modal = document.getElementById(modalID);
    modal.style.top = "50%";
    modal.style.left = "50%";
    modal.style.transform = "translate(-50%, -50%)";
    modal.classList.add("hidden");
}

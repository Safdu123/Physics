// Open and Close Menu Overlay
function openMenu() {
    document.getElementById('menuOverlay').classList.add('active');
}

function closeMenu() {
    document.getElementById('menuOverlay').classList.remove('active');
}

// Fetch and Display Blogs Dynamically
document.addEventListener("DOMContentLoaded", function () {
    fetch('getPosts.php')
        .then(response => response.json())
        .then(posts => {
            const blogContainer = document.getElementById("blog-posts"); // Use correct ID

            if (posts.length === 0) {
                blogContainer.innerHTML = "<p>No blogs available yet. Add some from the Admin Page.</p>";
            } else {
                posts.forEach(post => {
                    const blogCard = document.createElement("div");
                    blogCard.classList.add("blog-card");

                    blogCard.innerHTML = `
                        <img src="${post.image}" alt="${post.title}">
                        <h2>${post.title}</h2>
                        <p>${post.content.substring(0, 100)}...</p>
                        <a href="#">Read More</a>
                    `;

                    blogContainer.appendChild(blogCard);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching blogs:', error);
        });
});


// Fetch and Display Blogs Dynamically
document.addEventListener("DOMContentLoaded", function () {
    const blogs = JSON.parse(localStorage.getItem("blogs")) || [];
    const blogContainer = document.getElementById("blogContainer");

    if (blogs.length === 0) {
        blogContainer.innerHTML = "<p>No blogs available yet. Add some from the Admin Page.</p>";
    } else {
        blogs.forEach(blog => {
            const blogCard = document.createElement("div");
            blogCard.classList.add("blog-card");

            blogCard.innerHTML = `
                <img class="blog-image" src="${blog.image}" alt="${blog.title}">
                <div class="blog-content">
                    <h3 class="blog-title">${blog.title}</h3>
                    <p class="blog-description">${blog.description}</p>
                </div>
            `;

            blogContainer.appendChild(blogCard);
        });
    }
});



function redirectWithDelay(url) {
    // Add active class to play the animation
    event.target.classList.add('active');
    
    // Wait 1 second before redirecting
    setTimeout(() => {
        window.location.href = url;
    }, 1000); // 1000ms = 1 second
}

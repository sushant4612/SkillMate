// Sidebar
const menuItems = document.querySelectorAll('.menu-item');
// Get references to the button, modal overlay, and close button
const createPostBtn = document.getElementById('create-post-btn');
const modalOverlay = document.getElementById('modal-overlay');
const modalClose = document.getElementById('modal-close');

// Add event listener to toggle modal visibility when button is clicked
createPostBtn.addEventListener('click', function() {
    modalOverlay.style.display = 'block';
});

// Add event listener to close modal when close button is clicked
modalClose.addEventListener('click', function() {
    modalOverlay.style.display = 'none';
});


// Add an event listener to the "Add Post" button
document.getElementById('add-post-btn').addEventListener('click', function() {
    // Open the modal for adding a new post
    document.getElementById('modal-overlay').style.display = 'block';
});

// Event listener for submitting the post form
document.getElementById('post-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object to store form data
    var formData = new FormData(this);

    // Send a POST request to the AddPostController.php API
    fetch('../api/add_post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle the API response
        if (data.status === 'success') {
            // Post added successfully, close the modal
            document.getElementById('modal-overlay').style.display = 'none';
            // Optionally, reload the page or update the UI
        } else {
            // Display an error message if the post addition fails
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("error");
    });
});

// Event listener for deleting a post
// Example: You can bind this to a delete button in each post element
// document.getElementById('delete-post-btn').addEventListener('click', function() {
//     var postId = this.dataset.postId; // Get the post ID from the button data attribute

//     // Send a POST request to the DeletePostController.php API
//     fetch('../api/delete_post.php', {
//         method: 'POST',
//         body: JSON.stringify({ post_id: postId })
//     })
//     .then(response => response.json())
//     .then(data => {
//         // Handle the API response
//         if (data.status === 'success') {
//             // Post deleted successfully, update the UI or remove the post element
//         } else {
//             // Display an error message if the post deletion fails
//             alert(data.message);
//         }
//     })
//     .catch(error => {
//         console.error("error");
//     });
// });

// Messages 
const messageNotification = document.querySelector('#messages-notifications');
const messages = document.querySelector('.messages');
const message = messages.querySelectorAll('.message');
const messageSearch = document.querySelector('#message-search');

//Theme
const theme = document.querySelector('#theme');
const themeModal = document.querySelector('.customize-theme');
const fontSize = document.querySelectorAll('.choose-size span');
var root = document.querySelector(':root');
const colorPalette = document.querySelectorAll('.choose-color span');
const Bg1 = document.querySelector('.bg-1');
const Bg2 = document.querySelector('.bg-2');
const Bg3 = document.querySelector('.bg-3');


// ============== SIDEBAR ============== 

// Remove active class from all menu items
const changeActiveItem = () => {
    menuItems.forEach(item => {
        item.classList.remove('active');
    })
}

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        changeActiveItem();
        item.classList.add('active');
        if(item.id != 'notifications') {
            document.querySelector('.notifications-popup').
            style.display = 'none';
        } else {
            document.querySelector('.notifications-popup').
            style.display = 'block';
            document.querySelector('#notifications .notification-count').
            style.display = 'none';
        }
    })
})

// ============== MESSAGES ============== 

//Searches messages
const searchMessage = () => {
    const val = messageSearch.value.toLowerCase();
    message.forEach(user => {
        let name = user.querySelector('h5').textContent.toLowerCase();
        if(name.indexOf(val) != -1) {
            user.style.display = 'flex'; 
        } else {
            user.style.display = 'none';
        }
    })
}

//Search for messages
messageSearch.addEventListener('keyup', searchMessage);

//Highlight messages card when messages menu item is clicked
messageNotification.addEventListener('click', () => {
    messages.style.boxShadow = '0 0 1rem var(--color-primary)';
    messageNotification.querySelector('.notification-count').style.display = 'none';
    setTimeout(() => {
        messages.style.boxShadow = 'none';
    }, 2000);
})

// ============== THEME / DISPLAY CUSTOMIZATION ============== 

// Opens Modal
const openThemeModal = () => {
    themeModal.style.display = 'grid';
}

// Closes Modal
const closeThemeModal = (e) => {
    if(e.target.classList.contains('customize-theme')) {
        themeModal.style.display = 'none';
    }
}

themeModal.addEventListener('click', closeThemeModal);
theme.addEventListener('click', openThemeModal);


// ============== FONT SIZE ============== 

// remove active class from spans or font size selectors
const removeSizeSelectors = () => {
    fontSize.forEach(size => {
        size.classList.remove('active');
    })
}

fontSize.forEach(size => { 
   size.addEventListener('click', () => {
        removeSizeSelectors();
        let fontSize;
        size.classList.toggle('active');

        if(size.classList.contains('font-size-1')) { 
            fontSize = '10px';
            root.style.setProperty('----sticky-top-left', '5.4rem');
            root.style.setProperty('----sticky-top-right', '5.4rem');
        } else if(size.classList.contains('font-size-2')) { 
            fontSize = '13px';
            root.style.setProperty('----sticky-top-left', '5.4rem');
            root.style.setProperty('----sticky-top-right', '-7rem');
        } else if(size.classList.contains('font-size-3')) {
            fontSize = '16px';
            root.style.setProperty('----sticky-top-left', '-2rem');
            root.style.setProperty('----sticky-top-right', '-17rem');
        } else if(size.classList.contains('font-size-4')) {
            fontSize = '19px';
            root.style.setProperty('----sticky-top-left', '-5rem');
            root.style.setProperty('----sticky-top-right', '-25rem');
        } else if(size.classList.contains('font-size-5')) {
            fontSize = '22px';
            root.style.setProperty('----sticky-top-left', '-12rem');
            root.style.setProperty('----sticky-top-right', '-35rem');
        }

        // change font size of the root html element
        document.querySelector('html').style.fontSize = fontSize;
   })
})

// Remove active class from colors
const changeActiveColorClass = () => {
    colorPalette.forEach(colorPicker => {
        colorPicker.classList.remove('active');
    })
}

// Change color primary
colorPalette.forEach(color => {
    color.addEventListener('click', () => {
        let primary;
        changeActiveColorClass(); 

        if(color.classList.contains('color-1')) {
            primaryHue = 252;
        } else if(color.classList.contains('color-2')) {
            primaryHue = 52;
        } else if(color.classList.contains('color-3')) {
            primaryHue = 352;
        } else if(color.classList.contains('color-4')) {
            primaryHue = 152;
        } else if(color.classList.contains('color-5')) {
            primaryHue = 202;
        }

        color.classList.add('active');
        root.style.setProperty('--primary-color-hue', primaryHue);
    })
})

//Theme Background Values
let lightColorLightness;
let whiteColorLightness;
let darkColorLightness;

// Changes background color
const changeBG = () => {
    root.style.setProperty('--light-color-lightness', lightColorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--dark-color-lightness', darkColorLightness);
}

Bg1.addEventListener('click', () => {
    // add active class
    Bg1.classList.add('active');
    // remove active class from the others
    Bg2.classList.remove('active');
    Bg3.classList.remove('active');
    //remove customized changes from local storage
    window.location.reload();
});

Bg2.addEventListener('click', () => {
    darkColorLightness = '95%';
    whiteColorLightness = '20%';
    lightColorLightness = '15%';

    // add active class
    Bg2.classList.add('active');
    // remove active class from the others
    Bg1.classList.remove('active');
    Bg3.classList.remove('active');
    changeBG();
});

Bg3.addEventListener('click', () => {
    darkColorLightness = '95%';
    whiteColorLightness = '10%';
    lightColorLightness = '0%';

    // add active class
    Bg3.classList.add('active');
    // remove active class from the others
    Bg1.classList.remove('active');
    Bg2.classList.remove('active');
    changeBG();
});

document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch and render feed posts
    function fetchAndRenderFeedPosts() {
        // Fetch feed posts from the server
        fetch('../api/get_feed_posts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to retrieve feed posts.');
                }
                return response.json();
            })
            .then(data => {
                // Log the fetched data to the console
                console.log('Fetched data:', data);
    
                // Check if feed_posts property exists and is an array
                if (Array.isArray(data.feed_posts)) {
                    // Render the fetched feed posts
                    renderFeedPosts(data.feed_posts);
                } else {
                    throw new Error('Invalid feed data format.');
                }
            })
            .catch(error => {
                console.error(error.message);
            });
    }
    
    // Render feed posts initially when the page is loaded
    fetchAndRenderFeedPosts();

    // Function to render feed posts
    function renderFeedPosts(feedPosts) {
        const feedsContainer = document.querySelector('.feeds');
    
        // Clear existing feed posts
        feedsContainer.innerHTML = '';
    
        // Iterate over each feed post and create HTML markup
        feedPosts.forEach(post => {
            const feedMarkup = `
                <div class="feed">
                    <div class="head">
                        <div class="user">
                            <div class="profile-photo">
                                <img src="./images/profile-${post.user_id}.jpg">
                            </div>
                            <div class="info">
                                <h3>${post.username}</h3>
                                <small>${post.location}, ${post.timestamp}</small>
                            </div>
                        </div>
                        <span class="edit">
                            <i class="uil uil-ellipsis-h"></i>
                        </span>
                    </div>
                    <div class="photo">
                        <img src="${post.image_path}">
                    </div>
                    <div class="action-buttons">
                        <div class="interaction-buttons">
                            <span><i class="uil uil-heart"></i></span>
                            <span><i class="uil uil-comment-dots"></i></span>
                            <span><i class="uil uil-share-alt"></i></span>
                        </div>
                        <div class="bookmark">
                            <span><i class="uil uil-bookmark-full"></i></span>
                        </div>
                    </div>
                    <div class="liked-by">
                        <!-- Liked by users -->
                    </div>
                    <div class="caption">
                        <p><b>${post.username}</b> ${post.caption}</p>
                    </div>
                    <div class="comments text-muted">
                        View comments
                    </div>
                </div>
            `;
    
            // Append the feed markup to the feeds container
            feedsContainer.insertAdjacentHTML('beforeend', feedMarkup);
        });
    }    
});



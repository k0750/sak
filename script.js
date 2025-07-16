
  const toggleBtn = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');
  const aboutDropdown = document.getElementById('about-dropdown');
  let menuOpen = false;

  toggleBtn.addEventListener('click', () => {
    menuOpen = !menuOpen;
    navLinks.classList.toggle('show');
    toggleBtn.textContent = menuOpen ? '×' : '☰';
  });

  function toggleDropdown(e) {
    e.preventDefault();
    // On mobile: open/close About dropdown
    if (window.innerWidth <= 768) {
      aboutDropdown.classList.toggle('open');
    }
  }

  // Close menu when clicking outside (optional)
  document.addEventListener('click', function (e) {
    if (!navLinks.contains(e.target) && !toggleBtn.contains(e.target)) {
      navLinks.classList.remove('show');
      toggleBtn.textContent = '☰';
      menuOpen = false;
    }
  });

document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        question.classList.toggle('open');
        answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
    });
});

let cart = [];
    
function addToCart(itemName, itemPrice) {
    const item = { name: itemName, price: itemPrice };
    cart.push(item);
    renderCart();
}

function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    
    // Clear previous items
    cartItemsContainer.innerHTML = '';
    
    // Render cart items
    let total = 0;
    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `<span>${item.name}</span> <span>$${item.price}</span>`;
        cartItemsContainer.appendChild(cartItem);
        total += item.price;
    });

    // Update total amount
    cartTotal.innerHTML = `Total: $${total}`;
}

function donate() {
    if (cart.length === 0) {
        alert('Please add items to your cart before proceeding.');
    } else {
        alert('Thank you for your generous donation!');
        cart = []; // Reset cart after donation
        renderCart();
    }
}
$(document).ready(function() {
    $("#subscibernl").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
        var formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: "addsubscriber.php", // Replace with your API endpoint
            type: "POST", // Change to GET if needed
            data: formData,
            success: function(response) {
              alert(response);
            },
            error: function(xhr, status, error) {
              alert(error)
            }
        });
    });

    $("#subscibernlt").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
        var formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: "addsubscriber.php", // Replace with your API endpoint
            type: "POST", // Change to GET if needed
            data: formData,
            success: function(response) {
              alert(response);
            },
            error: function(xhr, status, error) {
              alert(error)
            }
        });
    });
});
  

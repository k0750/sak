function searchForChild() {
    const country = document.getElementById('country').value;
    const age = document.getElementById('age').value;
    const gender = document.getElementById('gender').value;
  
    fetch(`/search?county=${county}&age=${age}&gender=${gender}`)
      .then(response => response.json())
      .then(data => {
        const resultsDiv = document.getElementById('results');
        resultsDiv.innerHTML = '';
  
        if (data.length === 0) {
          resultsDiv.innerHTML = '<p>No children found.</p>';
          return;
        }
  
        data.forEach(child => {
          const childDiv = document.createElement('div');
          childDiv.innerHTML = `
            <img src="${child.photo_url}" alt="Child">
            <p>Name: ${child.name}</p>
            <p>Age: ${child.age}</p>
            <p>Gender: ${child.gender}</p>
            <p>Country: ${child.country}</p>
            <button onclick="alert('Sponsoring ${child.name}')">Sponsor</button>
          `;
          resultsDiv.appendChild(childDiv);
        });
      })
      .catch(error => console.error('Error:', error));
  }
  
import React from 'react';

const Logout = () => {
    
    fetch('/logout',{
        method: 'POST',
    }).then(response => {
        console.log(response);
    })
    .catch(error => {
      console.error('Error:', error);
    });

    return (
        <p>You've been logged out</p>
    );

}

export default Logout;

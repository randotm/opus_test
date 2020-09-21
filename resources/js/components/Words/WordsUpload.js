import React from 'react';
import ReactDOM from 'react-dom';

class WordsUpload extends React.Component {
    constructor(props) {
        super(props);

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit(event) {
        event.preventDefault();
        const fileInput = document.getElementById('wordsFile');
        const formData = new FormData();
        formData.append('upload', fileInput.files[0]);
        
        fetch('/upload',{
            method: 'POST',
            body: formData
        }).then(response => response.json())
        .then(result => {
          console.log('Success:', result);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    
    render() {
        return (
            <form onSubmit={this.handleSubmit}>
            <label>
                File:
                <input type="file" id="wordsFile" name="wordsFile" />
            </label>
            <input type="submit" value="Submit" />
            </form>
        );
    }
}

export default WordsUpload;
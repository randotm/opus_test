import React from 'react';
import ReactDOM from 'react-dom';

class WordsUpload extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            uploadStatus: '',
        };

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
          this.setState({uploadStatus: result});
        })
        .catch(error => {
          console.error('Error:', error);
          this.setState({uploadStatus: error});
        }).then(() => {
            document.getElementById('uploadResult').innerText = 'Status: ' + this.state.uploadStatus.message;
        })
    }
    
    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                <label>
                    File:
                    <input type="file" id="wordsFile" name="wordsFile" />
                </label>
                <input type="submit" value="Submit" />
                </form>
                <p id="uploadResult"></p>
            </div>
        );
    }
}

export default WordsUpload;
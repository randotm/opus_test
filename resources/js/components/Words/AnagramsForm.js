import React from 'react';
import ReactDOM from 'react-dom';
import AnagramsList from './AnagramsList'

class AnagramsForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            word: '',
            anagrams: []
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(event) {
        this.setState({word: event.target.value});
    }

    handleSubmit(event) {
        event.preventDefault();
        
        document.getElementById('word').innerText = 'Word: ' + this.state.word;

        let data = {
            "word": this.state.word,
        }
        fetch('/anagram',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
              },
            body: JSON.stringify(data)
        }).then(response => response.json())
        .then(result => {
          console.log('Success:', result);
          this.setState({anagrams: result});
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
    
  
    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                <label>
                    word:
                    <input type="text" value={this.state.word} onChange={this.handleChange} />
                </label>
                <input type="submit" value="Submit" />
                </form>
                <p id="word"></p>
                <AnagramsList anagrams={this.state.anagrams} />
            </div>
        );
    }
}

export default AnagramsForm

if (document.getElementById('anagramTable')) {
    ReactDOM.render(<AnagramsForm />, document.getElementById('anagramsForm'));
}

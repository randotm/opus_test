import React from 'react';
import ReactDOM from 'react-dom';

const AnagramsList = (props) => {
    
    const { anagrams } = props
    
    if (!anagrams.length) {
        return null;
    }

    const listItems = anagrams.map(anagram => {
        return <li key={anagram.id}>{anagram.word}</li>
    })

    return (
        <div>
            <p>Anagrams:</p>
            <ul>
                {listItems}
            </ul>
        </div>
    );

}

export default AnagramsList;
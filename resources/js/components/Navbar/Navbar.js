import React from 'react';
import ReactDOM from 'react-dom';
import {Route, NavLink, HashRouter} from "react-router-dom";

import AnagramsForm from '../Words/AnagramsForm';
import WordsUpload from '../Words/WordsUpload';
import Home from '../Home/Home';

class Navbar extends React.Component {
    render() {
        return (
            <HashRouter>
            <div>
                <ul className="header">
                <li><NavLink to="/">Home</NavLink></li>
                <li><NavLink to="/api/upload">Load words to database</NavLink></li>
                <li><NavLink to="/api/anagram">Find anagrams</NavLink></li>
                </ul>
                <div className="content">
                <Route exact path="/" component={Home}/>
                <Route exact path="/api/upload" component={WordsUpload}/>
                <Route exact path="/api/anagram" component={AnagramsForm}/>
                </div>
            </div>
            </HashRouter>
        );
    }
}

export default Navbar;

ReactDOM.render(<Navbar />, document.getElementById('root'));
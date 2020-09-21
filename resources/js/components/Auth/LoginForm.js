import React from 'react';
import ReactDOM from 'react-dom';

class LoginForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: ''
        };
    
        this.handleEmailChange = this.handleEmailChange.bind(this);
        this.handlePasswordChange = this.handlePasswordChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
  
    handleEmailChange(event) {
        this.setState({email: event.target.value});
    }

    handlePasswordChange(event) {
        this.setState({password: event.target.value});
    }
  
    handleSubmit(event) {
        event.preventDefault();

        let data = {
            "email": this.state.email,
            "password": this.state.password,
        }
        fetch('api/login',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
              },
            body: JSON.stringify(data)
        });
    }
  
    render() {
        return (
            <form onSubmit={this.handleSubmit}>
            <label>
                E-Mail address:
                <input type="email" value={this.state.value} onChange={this.handleEmailChange} />
            </label>
            <label>
                Password:
                <input type="password" value={this.state.value} onChange={this.handlePasswordChange} />
            </label>
            <input type="submit" value="Submit" />
            </form>
        );
    }
}

export default LoginForm;
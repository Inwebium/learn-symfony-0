import React from 'react';
import ReactDOM from 'react-dom';

class Questions extends React.Component
{
    constructor() {
        super();

        this.state = {
            items: []
        }
    }

    componentDidMount() {
        fetch(
            '/question/list', 
            {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                },
            }
        )
        .then(response => response.json())
        .then(items => {this.setState({items})});
    }

    render() {
        return (
            <div className="questions">
                <h1>Questions component</h1>
                {
                    this.state.items.map(({id, text, endsAt}) => (
                        <div>
                            <p>{text}</p>
                            <span>{endsAt}</span>
                        </div>
                    ))
                }
            </div>
        );
        
    };
};

export default Questions;
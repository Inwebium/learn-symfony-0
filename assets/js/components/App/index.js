import React from "react";
import ReactDOM from "react-dom";
import Questions from "../Questions/index.js";

class App extends React.Component {
    render() {
        return (
            <div className="app">
                <Questions />
            </div>
        );
    }
};

export default App;
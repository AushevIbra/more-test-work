import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class Example extends Component {
    constructor(props) {
        super(props)
        this.state = {
            data: null,
            usd: "",
            euro: "",
            rub: ""
        }
        this.getDate = this.getDate.bind(this);
    }

    componentWillMount() {
        this.getDate();
    }

    handleChange(e) {
        this.setState({
            [e.target.id]: e.target.value
        })
    }

    getDate() {
        window.axios.get('/api/distribution')
            .then(response => {
                this.setState({
                    data: response.data.data,
                    usd: response.data.data.usd,
                    rub: response.data.data.rub,
                    euro: response.data.data.euro,
                }, () => {
                    console.log(this.state);
                })

            })
    }

    handleSubmit() {
        const {usd, rub, euro} = this.state
        window.axios.post('/api/distribution', {usd, rub, euro})
            .then(response => {
                location.reload();
            })
            .catch(error => {
                alert(error.response.data.msg)
            })
    }

    render() {
        const {usd, rub, euro} = this.state;
        return (
            <div>
                <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Изменить
                </button>
                <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div className="modal-dialog" role="document">
                        <div className="modal-content">
                            <div className="modal-header">
                                <h5 className="modal-title" id="exampleModalLabel">Перераспределение</h5>
                                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div className="modal-body">
                                <form action="#" method="post">
                                    <div className="form-group">
                                        <label htmlFor="usd">USD</label>
                                        <input id="usd" type="text" value={usd} onChange={this.handleChange.bind(this)} className="form-control"/>
                                        <label htmlFor="usd">EURO</label>
                                        <input id="euro" type="text" value={euro} onChange={this.handleChange.bind(this)} className="form-control"/>
                                        <label htmlFor="usd">RUB</label>
                                        <input id="rub" value={rub} type="text" onChange={this.handleChange.bind(this)} className="form-control"/>
                                    </div>
                                </form>
                            </div>
                            <div className="modal-footer">
                                <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" className="btn btn-primary" onClick={this.handleSubmit.bind(this)}>Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example/>, document.getElementById('example'));
}

import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';

const $ = window.$;

function Modal() {
    const [values, setValues] = useState({
        text: "",
        parent_id: null,
        img: "",

    });

    const [messages, setMessages] = useState([]);
    useEffect(() => {

        $('.add-message').on('click', function () {
            const ref = $(this);
            setValues({
                ...values,
                parent_id: ref.data('id') || null
            });

            $('.modal').modal('toggle')
        })
    }, [])

    const handleChange = e => {
        if (undefined !== e.target.files) {
            return;
        }
        setValues({
            ...values,
            [e.target.name]: e.target.value
        });


    }

    const handleSubmit = e => {
        let tempErrros = [];
        e.preventDefault();

        let formData = new FormData();
        Object.keys(values).forEach(value => {

            if (null !== values[value]) {
                formData.append(value, values[value])
            }
        });

        formData.append('img', document.getElementById('file').files[0]);

        axios.post('/messages', formData)
            .then(response => {
                let message = {type: 'success', message: "Сообщение успешно добавлено"};
                setMessages([message]);
                setValues({
                    text: "",
                    parent_id: null,
                    img: null,

                })
            })
            .catch(error => {
                setMessages([]);
                Object.keys(error.response.data.errors).forEach(key => {
                    error.response.data.errors[key].forEach(item => {

                        tempErrros.push({type: 'danger', message: item});

                        setMessages(tempErrros);
                    })
                });
            })
    }

    return (
        <div className="modal" tabIndex="-1" role="dialog">
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title">Modal title</h5>
                        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form onSubmit={handleSubmit} encType={"multipart/form-data"}>
                        <div className="modal-body">
                            {messages.map((message, idx) => {
                                return (
                                    <div key={idx} className={`alert alert-${message.type}`} role="alert">
                                        {message.message}
                                    </div>
                                )
                            })}
                            <div className={'form-group'}>
                                <textarea onChange={handleChange} value={values.text}  name="text" className={"form-control"} cols="30"
                                          rows="10"
                                          placeholder="Text"></textarea>
                            </div>

                            <div className={'form-group'}>
                                <input type="file" id={'file'} name={'img'}  onChange={handleChange}/>
                            </div>

                        </div>
                        <div className="modal-footer">
                            <button type="submit" className="btn btn-primary">Save</button>
                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

export default Modal;

if (document.getElementById('modal')) {
    ReactDOM.render(<Modal/>, document.getElementById('modal'));
}

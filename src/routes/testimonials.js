import express from 'express';
import Testimonial from '../models/Testimonial.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Testimonial, resource: 'testimonials' });

export default router;
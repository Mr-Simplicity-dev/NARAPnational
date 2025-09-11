import express from 'express';
import Offer from '../models/Offer.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Offer, resource: 'offers' });

export default router;
